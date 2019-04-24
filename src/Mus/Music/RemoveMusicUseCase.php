<?php

namespace Mus\Music;

use Mus\Music\Exception\MusicNotFoundException;
use Mus\Music\Gateway\MusicAccessGateway;

class RemoveMusicUseCase
{
    private $musicAccessGateway;
    public function __construct(MusicAccessGateway $musicAccessGateway)
    {
        $this->musicAccessGateway = $musicAccessGateway;
    }

    public function removeById(string $id): void
    {
        $music = $this->musicAccessGateway->findById($id);
        if($music === null){
            throw new MusicNotFoundException("No music with the id: " . $id . " was found");
        }
        $this->musicAccessGateway->remove($music);
    }
}
