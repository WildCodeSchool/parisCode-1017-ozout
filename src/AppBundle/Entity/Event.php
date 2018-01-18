<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
{
    // CODE RELATION /////////////////////////////////////////////////
    public function __toString()
    {
        // Return the name of event in reservation table.
        return $this->title;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
        $this->start = new \DateTime();
        $this->deadline = new \DateTime();
    }

    /**
     *
     * @var \AppBundle\Entity\Reservation $reservations
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reservation", mappedBy="event")
     */
    private $reservations;

    /**
     * @var \AppBundle\Entity\Review $reviews
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="event")
     */
    private $reviews;

    /**
     * @var \AppBundle\Entity\Picture $picture
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Picture", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $picture;

    /**
     * @var \AppBundle\Entity\Category $category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="events"))
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    ///////////////////////////////////////////////////////////////////

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255)
     */
    private $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="zipcode", type="integer", length=5)
     */
    private $zipcode;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var int
     *
     * @ORM\Column(name="targetMoney", type="integer")
     */
    private $targetMoney;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="date")
     */
    private $deadline;

    /**
     * @var bool
     *
     * @ORM\Column(name="isPrivate", type="boolean")
     */
    private $isPrivate;

    /**
     * @var int
     *
     * @ORM\Column(name="maxPeople", type="integer")
     */
    private $maxPeople;

    /**
     * @var int
     *
     * @ORM\Column(name="onGoingMoney", type="integer")
     */
    private $onGoingMoney;


    /** Generate code */

    ////////////////////////////////////////////////////////////////

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
     * Set title.
     *
     * @param string $title
     *
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set adress.
     *
     * @param string $adress
     *
     * @return Event
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress.
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return Event
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipcode.
     *
     * @param int $zipcode
     *
     * @return Event
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode.
     *
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set latitude.
     *
     * @param float $latitude
     *
     * @return Event
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude.
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude.
     *
     * @param float $longitude
     *
     * @return Event
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set start.
     *
     * @param \DateTime $start
     *
     * @return Event
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start.
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set targetMoney.
     *
     * @param int $targetMoney
     *
     * @return Event
     */
    public function setTargetMoney($targetMoney)
    {
        $this->targetMoney = $targetMoney;

        return $this;
    }

    /**
     * Get targetMoney.
     *
     * @return int
     */
    public function getTargetMoney()
    {
        return $this->targetMoney;
    }

    /**
     * Set deadline.
     *
     * @param \DateTime $deadline
     *
     * @return Event
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline.
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set isPrivate.
     *
     * @param bool $isPrivate
     *
     * @return Event
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    /**
     * Get isPrivate.
     *
     * @return bool
     */
    public function getIsPrivate()
    {
        return $this->isPrivate;
    }

    /**
     * Set maxPeople.
     *
     * @param int $maxPeople
     *
     * @return Event
     */
    public function setMaxPeople($maxPeople)
    {
        $this->maxPeople = $maxPeople;

        return $this;
    }

    /**
     * Get maxPeople.
     *
     * @return int
     */
    public function getMaxPeople()
    {
        return $this->maxPeople;
    }

    /**
     * Set onGoingMoney.
     *
     * @param int $onGoingMoney
     *
     * @return Event
     */
    public function setOnGoingMoney($onGoingMoney)
    {
        $this->onGoingMoney = $onGoingMoney;

        return $this;
    }

    /**
     * Get onGoingMoney.
     *
     * @return int
     */
    public function getOnGoingMoney()
    {
        return $this->onGoingMoney;
    }

    /**
     * Add reservation.
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return Event
     */
    public function addReservation(\AppBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation.
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReservation(\AppBundle\Entity\Reservation $reservation)
    {
        return $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Add review.
     *
     * @param \AppBundle\Entity\Review $review
     *
     * @return Event
     */
    public function addReview(\AppBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review.
     *
     * @param \AppBundle\Entity\Review $review
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReview(\AppBundle\Entity\Review $review)
    {
        return $this->reviews->removeElement($review);
    }

    /**
     * Get reviews.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Set picture.
     *
     * @param \AppBundle\Entity\Picture|null $picture
     *
     * @return Event
     */
    public function setPicture(\AppBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return \AppBundle\Entity\Picture|null
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set category.
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Event
     */
    public function setCategory(\AppBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
