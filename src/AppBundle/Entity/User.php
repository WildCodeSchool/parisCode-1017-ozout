<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="`user`"))
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    // Added Code
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    // CLI Auto-generated code
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=45)
     */
    private $role;


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

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }


}
