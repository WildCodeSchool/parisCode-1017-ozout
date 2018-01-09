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
    // CODE RELATION ///////////////////////////////////////////////////////
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="reservations"))
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

////////////////////////////////////////////////////////////////////////////

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
}
