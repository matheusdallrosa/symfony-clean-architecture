<?php

namespace Mus\Music\Entity;

use Mus\Music\Exception\InvalidMusicDataException;

class Music {
    private $id;

    private $durationInSeconds;

    private $title;

    private $lyrics;

    public function __construct(
        int $durationInSeconds,
        string $title,
        string $lyrics
    )
    {
        $violations = [];
        if($durationInSeconds <= 0){
            $violations['duration'] = 'The duration must be an integer greater than 0.';
        }

        if(strlen(trim($title)) === 0){
            $violations['title'] = 'The title must not be empty.';
        }

        if(strlen(trim($lyrics)) === 0){
            $violations['lyrics'] = 'The lyrics must not be empty.';
        }

        if(count($violations) > 0){
            throw new InvalidMusicDataException(
                "Invalid data for a Music",
                $violations
            );
        }

        $this->id = null;
        $this->durationInSeconds = $durationInSeconds;
        $this->title = $title;
        $this->lyrics = $lyrics;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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
}
