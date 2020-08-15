<?php

namespace VOXApi\Models;

/**
 * Slide photo class
 *
 * @category Model
 * @author deoomen <deoomen@pm.me>
 */
class SlidePhoto extends Model
{
    private int $id_slide;
    private string $filename;
    private ?int $no;

    /**
     * Init `SlidePhoto` object
     *
     * @param \stdClass $object slide photo raw object data
     */
    public function __construct(\stdClass $object)
    {
        $this->id = $object->id ?? 0;
        $this->id_slide = $object->id_slide;
        $this->filename = $object->filename;
        $this->no = $object->no;
    }

    /**
     * Return slide photo as array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "filename" => $this->filename
        ];
    }
}
