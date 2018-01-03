DC=docker-compose
restart: stop start

init:                ## Init project (Does not work on Windows!)
	@echo "\n# ozout" | sudo tee --append /etc/hosts
	@echo "127.0.0.1       ozout.dev.fr" | sudo tee --append /etc/hosts

clean:               ## Clean your env (Stop/remove containers, networks, images, and volumes)
	$(DC) down -v --rmi local --remove-orphans

install: clean
	$(DC) create --build --force-recreate

start:               ## Start your environment
	$(DC) up -d
	@$(DC) exec ozout-fpm bash -c "setfacl -R -m u:www-data:rwX var"

stop:                ## Stop your environment
	$(DC) stop

restart:             ## Stop and restart your box

status:              ## Get your environment status
	$(DC) ps

logs:                ## Tail output from wyndpay
	$(DC) logs -f ozout

composer:            ## Run composer install
	$(DC) run --rm composer bash -c "composer global --no-interaction require "hirak/prestissimo:^0.3" && composer install -o"