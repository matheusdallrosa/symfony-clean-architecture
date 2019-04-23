<?php

namespace Mus\Music\DataTransferObject;

use Mus\Music\Entity\Music;
use Mus\Music\Exception\MusicNotSavedException;

class MusicFoundResponseDto extends MusicDto
{
    private $id;
    public function __construct(Music $music)
    {
        $this->id = $music->getId();
        if($this->id === null){
            throw new MusicNotSavedException("You can't create a MusicFoundResponseDto from a Music without an id.");
        }
        $this->durationInSeconds = $music->getDurationInSeconds();
        $this->title = $music->getTitle();
        $this->lyrics = $music->getLyrics();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        $fields = parent::toArray();
        $fields['id'] = $this->id;
        return $fields;
    }
}