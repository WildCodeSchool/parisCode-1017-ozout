<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */

class Reservation
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="reservations"))
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="reservations"))
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="moneyGiven", type="integer")
     */
    private $moneyGiven;

    /**
     * @var int
     *
     * @ORM\Column(name="isCreator", type="boolean")
     */
    private $isCreator;

    /**
     * @var bool
     *
     * @ORM\Column(name="doParticipate", type="boolean")
     */
    private $doParticipate;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set moneyGiven.
     *
     * @param int $moneyGiven
     *
     * @return Reservation
     */
    public function setMoneyGiven($moneyGiven)
    {
        $this->moneyGiven = $moneyGiven;

        return $this;
    }

    /**
     * Get moneyGiven.
     *
     * @return int
     */
    public function getMoneyGiven()
    {
        return $this->moneyGiven;
    }

    /**
     * Set doParticipate.
     *
     * @param bool $doParticipate
     *
     * @return Reservation
     */
    public function setDoParticipate($doParticipate)
    {
        $this->doParticipate = $doParticipate;

        return $this;
    }

    /**
     * Get doParticipate.
     *
     * @return bool
     */
    public function getDoParticipate()
    {
        return $this->doParticipate;
    }

    /**
     * Set event.
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return Reservation
     */
    public function setEvent(\AppBundle\Entity\Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event.
     *
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Reservation
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set isCreator.
     *
     * @param bool $isCreator
     *
     * @return Reservation
     */
    public function setIsCreator($isCreator)
    {
        $this->isCreator = $isCreator;

        return $this;
    }

    /**
     * Get isCreator.
     *
     * @return bool
     */
    public function getIsCreator()
    {
        return $this->isCreator;
    }
}
