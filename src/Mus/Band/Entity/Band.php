<?php

namespace Mus\Band\Entity;

use Mus\Artist\Entity\Artist;
use Mus\Author\Entity\Author;

class Band extends Author
{
    private $artists;

    public function addArtist(Artist $artist): void
    {
        $this->artists[] = $artist;
    }

    public function removeArtist(Artist $artistToBeRemoved): void
    {
        $this->artists = array_filter(
            $this->artists,
            function(Artist $artistFromBand) use ($artistToBeRemoved){
                return $artistFromBand->getId() !== $artistToBeRemoved->getId();
            }
        );
    }
}