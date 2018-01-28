<?php

namespace AppBundle\Service;

use AppBundle\Entity\Picture;

/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 11/01/18
 * Time: 23:24
 */

class FileUploader
{

    /**
     * Target to uploads Directory
     *
     * @var string $targetDir
     */
    private $targetDir;

    /**
     * FileUploader constructor.
     *
     * Define targetDirectory from arguments service declaration
     *
     * @param $targetDir
     */
    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /**
     * Upload file from Picture entity
     *
     * @param \AppBundle\Entity\Picture $picture
     */
    public function upload(Picture $picture)
    {
        $file = $picture->getPictureUpload();

        $fileName = uniqid() . '.' . $file->guessExtension();
        $file->move($this->targetDir, $fileName);

        $picture->setNamePicture($fileName);
    }

    /**
     * Update file, remove old et create new
     *
     * @param \AppBundle\Entity\Picture $picture
     */
    public function update(Picture $picture)
    {
        $this->remove($picture);
        $this->upload($picture);
    }

    /**
     * Check if file exists and remove if is ok
     *
     * @param \AppBundle\Entity\Picture $picture
     */
    public function remove(Picture $picture)
    {
        $file = $this->targetDir . $picture->getNamePicture();
        if (file_exists($file)) {
            unlink($this->targetDir . $picture->getNamePicture());
        }
    }
}