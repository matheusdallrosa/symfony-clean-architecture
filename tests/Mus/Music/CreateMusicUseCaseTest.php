<?php

namespace Mus\Music;

use Mus\Music\DataTransferObject\CreateMusicRequestDto;
use Mus\Music\Exception\MusicNotSavedException;
use Mus\Music\Entity\Music;
use Mus\Music\Gateway\MusicAccessGateway;
use PHPUnit\Framework\TestCase;

class CreateMusicUseCaseTest extends TestCase {

    public function testShouldCreateAMusicCorrectly(): void
    {
        $mockedMusicAccessGateway = $this->getMockBuilder(MusicAccessGateway::class)
                                        ->setMethods(['save', 'findById', 'remove'])
                                        ->getMock();

        $duration = 142;
        $title = "test song";
        $lyrics = "test lyrics for the test song";

        $music = new Music($duration, $title, $lyrics);
        $mockedMusicAccessGateway->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Music::class))
            ->willReturn($music);

        $reflection = new \ReflectionClass(Music::class);
        $reflectionProperty = $reflection->getProperty("id");
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($music, 1);

        $createMusicRequestDto = new CreateMusicRequestDto(
            $duration,
            $title,
            $lyrics
        );
        $createMusicUseCase = new CreateMusicUseCase($mockedMusicAccessGateway);

        $createMusicResponseDto = $createMusicUseCase->createMusic($createMusicRequestDto);

        $this->assertEquals(
            $music->getId(),
            $createMusicResponseDto->getId()
        );

        $this->assertEquals(
            $music->getDurationInSeconds(),
            $createMusicResponseDto->getDurationInSeconds()
        );

        $this->assertEquals(
            $music->getTitle(),
            $createMusicResponseDto->getTitle()
        );

        $this->assertEquals(
            $music->getLyrics(),
            $createMusicResponseDto->getLyrics()
        );
    }

    public function testShouldReceiveAnMusicNotSavedException(): void{
        $mockedMusicAccessGateway = $this->getMockBuilder(MusicAccessGateway::class)
            ->setMethods(['save', 'findById', 'remove'])
            ->getMock();

        $duration = 142;
        $title = "test song";
        $lyrics = "test lyrics for the test song";

        $mockedMusicAccessGateway->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Music::class))
            ->willReturn(new Music($duration, $title, $lyrics));


        $this->expectException(MusicNotSavedException::class);

        $createMusicUseCase = new CreateMusicUseCase($mockedMusicAccessGateway);
        $createMusicUseCase->createMusic(
            new CreateMusicRequestDto(
                $duration,
                $title,
                $lyrics
            )
        );
    }
}

