<?php

namespace Mus\Music\DataTransferObject;

abstract class MusicDto {
    protected $durationInSeconds;

    protected $title;

    protected $lyrics;

    public function getDurationInSeconds(): int
    {
        return $this->durationInSeconds;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLyrics(): string
    {
        return $this->lyrics;
    }

    public function toArray(): array
    {
        return [
            'durationInSeconds' => $this->durationInSeconds,
            'title' => $this->title,
            'lyrics' => $this->lyrics,
        ];
    }
}
