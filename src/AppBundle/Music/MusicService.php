<?php

namespace AppBundle\Music;

use Mus\Music\CreateMusicUseCase;
use Mus\Music\DataTransferObject\CreateMusicRequestDto;
use Mus\Music\DataTransferObject\CreateMusicResponseDto;
use Mus\Music\DataTransferObject\MusicFoundResponseDto;
use Mus\Music\FindMusicUseCase;
use Mus\Music\Gateway\MusicAccessGateway;
use Mus\Music\RemoveMusicUseCase;

class MusicService
{
    private $musicAccess;
    public function __construct(MusicAccessGateway $musicAccess)
    {
        $this->musicAccess = $musicAccess;
    }

    public function createMusic(
        CreateMusicRequestDto $createMusicRequestDto
    ): CreateMusicResponseDto
    {
        $createMusicUseCase = new CreateMusicUseCase($this->musicAccess);
        return $createMusicUseCase->createMusic($createMusicRequestDto);
    }

    public function findMusicById(int $id): MusicFoundResponseDto
    {
        $findMusicUseCase = new FindMusicUseCase($this->musicAccess);
        return $findMusicUseCase->findById($id);
    }

    public function removeMusicById(int $id): void
    {
        $removeMusicUseCase = new RemoveMusicUseCase($this->musicAccess);
        $removeMusicUseCase->removeById($id);
    }
}