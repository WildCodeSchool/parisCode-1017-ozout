<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event implements JsonSerializable
{
    //Added code
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link   http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since  5.4.0
     */
    public function jsonSerialize()
    {
        return [
            "lat" => $this->latitude,
            "lng" => $this->longitude
        ];
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
        $this->onGoingMoney = 0;
        $this->isValid = false;
        $this->nbPeopleParticipate=0;
    }

    //CLI auto-generated code

    /**
     *
     * @var \AppBundle\Entity\Reservation $reservations
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reservation", mappedBy="event", orphanRemoval=true, cascade={"all"})
     */
    private $reservations;

    /**
     * @var \AppBundle\Entity\Review $reviews
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", cascade={"all"}, mappedBy="event")
     */
    private $reviews;

    /**
     * @var \AppBundle\Entity\Picture $picture
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Picture", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $picture;

    /**
     * @var \AppBundle\Entity\Category $category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="events"))
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

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
     * @ORM\Column(name="latitude", type="float", nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", nullable=true)
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
     * @ORM\Column(name="deadline", type="datetime")
     */
    private $deadline;

    /**
     * @var bool
     *
     * @ORM\Column(name="isPrivate", type="boolean", nullable=true)
     */
    private $isPrivate;

    /**
     * @var int
     *
     * @ORM\Column(name="maxPeople", type="integer", nullable=true)
     */
    private $maxPeople;

    /**
     * @var int
     *
     * @ORM\Column(name="onGoingMoney", type="integer", nullable=true)
     */
    private $onGoingMoney;

    /**
     * @var string
     *
     * @ORM\Column(name="eventDescription", type="text")
     */
    private $eventDescription;

    /**
     * @var
     *
     * @ORM\Column(name="is_valid", type="integer")
     */
    private $isValid;

    /**
     * @var $nbPeopleParticipate
     *
     * @ORM\Column(name="nb_people_participate", type="integer")
     */
    private $nbPeopleParticipate;

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
     * @param float|null $latitude
     *
     * @return Event
     */
    public function setLatitude($latitude = null)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude.
     *
     * @return float|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude.
     *
     * @param float|null $longitude
     *
     * @return Event
     */
    public function setLongitude($longitude = null)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return float|null
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
     * @param bool|null $isPrivate
     *
     * @return Event
     */
    public function setIsPrivate($isPrivate = null)
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    /**
     * Get isPrivate.
     *
     * @return bool|null
     */
    public function getIsPrivate()
    {
        return $this->isPrivate;
    }

    /**
     * Set maxPeople.
     *
     * @param int|null $maxPeople
     *
     * @return Event
     */
    public function setMaxPeople($maxPeople = null)
    {
        $this->maxPeople = $maxPeople;

        return $this;
    }

    /**
     * Get maxPeople.
     *
     * @return int|null
     */
    public function getMaxPeople()
    {
        return $this->maxPeople;
    }

    /**
     * Set onGoingMoney.
     *
     * @param int|null $onGoingMoney
     *
     * @return Event
     */
    public function setOnGoingMoney($onGoingMoney = null)
    {
        $this->onGoingMoney = $onGoingMoney;

        return $this;
    }

    /**
     * Get onGoingMoney.
     *
     * @return int|null
     */
    public function getOnGoingMoney()
    {
        return $this->onGoingMoney;
    }

    /**
     * Set eventDescription.
     *
     * @param string $eventDescription
     *
     * @return Event
     */
    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;

        return $this;
    }

    /**
     * Get eventDescription.
     *
     * @return string
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
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

    /**
     * @return mixed
     */
    public function getisValid()
    {
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }

    /**
     * @return mixed
     */
    public function getNbPeopleParticipate()
    {
        return $this->nbPeopleParticipate;
    }

    /**
     * @param mixed $nbPeopleParticipate
     */
    public function setNbPeopleParticipate($nbPeopleParticipate)
    {
        $this->nbPeopleParticipate = $nbPeopleParticipate;
    }
}
