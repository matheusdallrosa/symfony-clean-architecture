<?php

namespace Mus\Music;

use Mus\Music\DataTransferObject\MusicFoundResponseDto;
use Mus\Music\Exception\MusicNotFoundException;
use Mus\Music\Gateway\MusicAccessGateway;

class FindMusicUseCase
{
    private $musicAccessGateway;
    public function __construct(MusicAccessGateway $musicAccessGateway)
    {
        $this->musicAccessGateway = $musicAccessGateway;
    }

    public function findById(int $id): MusicFoundResponseDto
    {
        $music = $this->musicAccessGateway->findById($id);
        if($music === null){
            throw new MusicNotFoundException("No music with the id: " . $id . " was found");
        }
        return new MusicFoundResponseDto($music);
    }
}