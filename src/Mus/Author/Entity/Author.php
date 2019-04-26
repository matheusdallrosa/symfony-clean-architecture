<?php

namespace Mus\Author\Entity;

use Mus\Album\Entity\Album;
use Mus\Music\Entity\Music;

abstract class Author
{
    private $id;

    private $name;

    private $bio;

    private $genres;

    private $singles;

    private $albums;

    public function __construct(
        string $name,
        string $bio,
        array $genres,
        array $singles,
        array $albums
    )
    {
        $this->name = $name;
        $this->bio = $bio;
        $this->genres = $genres;
        $this->singles = $singles;
        $this->albums = $albums;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function getSingles(): array
    {
        return $this->singles;
    }

    public function addSingle(Music $single): void
    {
        $this->singles[] = $single;
    }

    public function getAlbums(): array
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): void
    {
        $this->albums[] = $album;
    }
}