<?php

namespace Mus\Music\DataTransferObject;

use Mus\Music\Exception\MusicNotSavedException;
use Mus\Music\Entity\Music;

class CreateMusicResponseDto extends MusicDto {

    private $id;

    public function __construct(Music $music)
    {
        $this->id = $music->getid();
        if($this->id === null){
            throw new MusicNotSavedException("You can't create a CreateMusicResponseDto from a Music without an id.");
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