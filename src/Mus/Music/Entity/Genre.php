<?php

namespace Mus\Music\Entity;

class Genre
{
    const ROCK = "Rock";
    const GARAGE_ROCK = "Garage Rock";
    const INDIE_ROCK = "Indie Rock";

    public static function getGenres(): array
    {
        return [
            Genre::ROCK,
            Genre::GARAGE_ROCK,
            Genre::INDIE_ROCK
        ];
    }
}