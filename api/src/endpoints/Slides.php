<?php

namespace VOXApi\Endpoints;

use VOXApi\Endpoints\Api;
use VOXApi\Models\Slide;
use VOXApi\Models\SlidePhoto;

/**
 * @category Api
 * @author deoomen <deoomen@pm.me>
 */
class Slides extends Api
{
    /**
     * Init, set table name and default per page
     */
    public function __construct()
    {
        parent::__construct();

        $this->tableName = "slide";
        $this->setPerPage(999);
    }

    /**
     * Undocumented function
     *
     * @return Slide[]
     */
    public function getItems(): array
    {
        $stmt = $this->database->prepare(
            "SELECT `s`.`id`, `s`.`title`, `s`.`text`, `s`.`no`
            FROM `{$this->tableName}` AS `s`
            ORDER BY -`s`.`no` DESC, `s`.`id` ASC
            LIMIT {$this->getOffset()}, {$this->getPerPage()}"
        );

        $items = [];
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                $slide = new Slide($row);
                $slide->setPhotos($this->getSlidePhotos($slide->getId()));
                $items[] = $slide;
            }
        }

        return $items;
    }

    private function getSlidePhotos(int $idSlide): array
    {
        $stmt = $this->database->prepare(
            "SELECT `sp`.`id`, `sp`.`id_slide`, `sp`.`filename`, `sp`.`no`
            FROM `slide_photo` AS `sp`
            WHERE `sp`.`id_slide` = ?
            ORDER BY -`sp`.`no` DESC, `sp`.`id` ASC
            LIMIT 0, 8"
        );
        $stmt->bindParam(1, $idSlide);

        $photos = [];
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                $photos[] = new SlidePhoto($row);
            }
        }

        return $photos;
    }

    public function getItemsAsArray(): array
    {
        $asArray = [];
        foreach ($this->getItems() as $slide) {
            $asArray[] = $slide->toArray();
        }

        return $asArray;
    }
}
