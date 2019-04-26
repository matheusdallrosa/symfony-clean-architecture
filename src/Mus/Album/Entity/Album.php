<?php

namespace Mus\Album\Entity;

class Album
{
    private $id;

    private $title;

    private $music;

    public function __construct(
        string $title,
        array $music
    )
    {
        $this->title = $title;
        $this->music = $music;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMusic(): array
    {
        return $this->music;
    }
}