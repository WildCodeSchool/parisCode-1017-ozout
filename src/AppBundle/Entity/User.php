<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
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
     * @ORM\Column(name="nameUser", type="string", length=45)
     */
    private $nameUser;

    /**
     * @var string
     *
     * @ORM\Column(name="surnameUser", type="string", length=45)
     */
    private $surnameUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfBirth", type="date")
     */
    private $dateOfBirth;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameUser
     *
     * @param string $nameUser
     *
     * @return User
     */
    public function setNameUser($nameUser)
    {
        $this->nameUser = $nameUser;

        return $this;
    }

    /**
     * Get nameUser
     *
     * @return string
     */
    public function getNameUser()
    {
        return $this->nameUser;
    }

    /**
     * Set surnameUser
     *
     * @param string $surnameUser
     *
     * @return User
     */
    public function setSurnameUser($surnameUser)
    {
        $this->surnameUser = $surnameUser;

        return $this;
    }

    /**
     * Get surnameUser
     *
     * @return string
     */
    public function getSurnameUser()
    {
        return $this->surnameUser;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
}

