<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PictureRepository")
 */
class Picture
{
    // Added code
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->namePicture;
    }

    //CLI auto-generated code
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
     * @ORM\Column(name="namePicture", type="string", length=45, nullable=true)
     */
    private $namePicture;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="altPicture", type="string", length=100, nullable=true)
     */
    private $altPicture;

    /**
     * @var string $pictureUpload
     * @Assert\NotBlank(message= "Vous n'avez pas choisi d'image ?")
     * @Assert\File(
     *     maxSize = "2097152",
     *     maxSizeMessage = "Votre fichier est trop lourd, il doit être inférieur à 2Mo.",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Votre fichier doit être de type jpg, gif ou png")
     */
    private $pictureUpload;


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
     * Set namePicture.
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
     * Get namePicture.
     *
     * @return string
     */
    public function getNamePicture()
    {
        return $this->namePicture;
    }

    /**
     * Set description.
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
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set altPicture.
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
     * Get altPicture.
     *
     * @return string
     */
    public function getAltPicture()
    {
        return $this->altPicture;
    }

    /**
     * Set pictureUpload.
     *
     * @param string $pictureUpload
     *
     * @return Picture
     */
    public function setPictureUpload($pictureUpload)
    {
        $this->pictureUpload = $pictureUpload;

        return $this;
    }

    /**
     * Get pictureUpload.
     *
     * @return string
     */
    public function getPictureUpload()
    {
        return $this->pictureUpload;
    }
}
