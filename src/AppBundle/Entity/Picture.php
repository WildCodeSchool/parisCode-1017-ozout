<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PictureRepository")
 */
class Picture
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
     * @ORM\Column(name="namePicture", type="string", length=45)
     */
    private $namePicture;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="altPicture", type="string", length=100)
     */
    private $altPicture;


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
     * Set namePicture
     *
     * @param string $namePicture
     *
     * @return Picture
     */
    public function setNamePicture($namePicture)
    {
        $this->namePicture = $namePicture;

        return $this;
    }

    /**
     * Get namePicture
     *
     * @return string
     */
    public function getNamePicture()
    {
        return $this->namePicture;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Picture
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set altPicture
     *
     * @param string $altPicture
     *
     * @return Picture
     */
    public function setAltPicture($altPicture)
    {
        $this->altPicture = $altPicture;

        return $this;
    }

    /**
     * Get altPicture
     *
     * @return string
     */
    public function getAltPicture()
    {
        return $this->altPicture;
    }
}

