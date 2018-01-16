(function($){
    var star = $('.rating span');
    var starSelected = $('.rating span.active');
    var input = $('#appbundle_review_score');

    $('#appbundle_review_score').val(starSelected.attr('data-score'));

    star.hover(function(){
        star.removeClass('active');
    }, function(){
        starSelected.addClass('active');
    });

    star.on('click',function(){
        star.removeClass('active');
        $(this).addClass('active');
        starSelected = $(this);
        input.val($(this).attr('data-score'));
    });
})(jQuery);