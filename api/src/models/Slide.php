<?php

namespace VOXApi\Models;

/**
 * Slide class
 *
 * @category Model
 * @author deoomen <deoomen@pm.me>
 */
class Slide extends Model
{
    private string $title;
    private string $text;
    private ?int $no;

    /**
     * @var SlidePhoto[]
     */
    private array $photos;

    /**
     * Init `Slide` object
     *
     * @param \stdClass $object slide raw object data
     */
    public function __construct(\stdClass $object)
    {
        $this->id = $object->id ?? 0;
        $this->title = $object->title;
        $this->text = $object->text;
        $this->no = $object->no;
    }

    /**
     * Set slide photos
     *
     * @param SlidePhoto[] $photos slide array of photos
     *
     * @return void
     */
    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    /**
     * Return slide as array
     *
     * @return array
     */
    public function toArray(): array
    {
        $photos = [];
        foreach ($this->photos as $photo) {
            $photos[] = $photo->toArray();
        }

        return [
            "id" => $this->id,
            "title" => $this->title,
            "text" => $this->text,
            "photos" => $photos
        ];
    }
}
