<?php

namespace Mus\Music\DataTransferObject;

use Mus\Music\Entity\Music;

class MusicFoundResponseDto extends MusicDto
{
    private $id;
    public function __construct(Music $music)
    {
        $this->id = $music->getId();
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