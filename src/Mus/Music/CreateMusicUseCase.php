<?php

namespace Mus\Music;

use Mus\Music\DataTransferObject\CreateMusicRequestDto;
use Mus\Music\DataTransferObject\CreateMusicResponseDto;
use Mus\Music\Entity\Music;
use Mus\Music\Gateway\MusicAccessGateway;

class CreateMusicUseCase {
    private $musicAccessGateway;

    public function __construct(MusicAccessGateway $musicAccessGateway)
    {
        $this->musicAccessGateway = $musicAccessGateway;
    }

    public function createMusic(CreateMusicRequestDto $createMusicRequestDto): CreateMusicResponseDto
    {
        $notSavedNewMusic = new Music(
            $createMusicRequestDto->getDurationInSeconds(),
            $createMusicRequestDto->getTitle(),
            $createMusicRequestDto->getLyrics()
        );
        $savedNewMusic = $this->musicAccessGateway->save($notSavedNewMusic);
        return new CreateMusicResponseDto($savedNewMusic);
    }
}
