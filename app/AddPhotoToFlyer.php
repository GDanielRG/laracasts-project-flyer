<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyer
{
    /**
     * The flyer instance.
     *
     * @var Flyer
     */
    protected $flyer;

    /**
     * The UploadedFile instance.
     *
     * @var UploadedFile
     */
    protected $file;

    /**
     * Create a new AddPhotoToFlyer form object.
     *
     * @param Flyer          $flyer
     * @param UploadedFile   $file
     * @param Thumbnail|null $thumbnail
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    /**
     * Process the form.
     *
     * @return void
     */
    public function save()
    {
        $photo = $this->flyer->addPhoto($this->makePhoto());

        $this->file->move($photo->baseDir(), $photo->name);

        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }

    /**
     * Make a photo instance.
     *
     * @return Photo
     */
    protected function makePhoto()
    {
        return new Photo(['name' => $this->fileName()]);
    }

    /**
     * Make a filename, based on the uploaded file.
     *
     * @return string
     */
    public function fileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

}
