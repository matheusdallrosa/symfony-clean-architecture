<?php

namespace Tests\Mus\Music;

use Mus\Music\Entity\Music;
use Mus\Music\Exception\MusicNotFoundException;
use Mus\Music\FindMusicUseCase;
use Mus\Music\Gateway\MusicAccessGateway;
use PHPUnit\Framework\TestCase;

class FindMusicUseCaseTest extends TestCase
{
    public function testShouldFindAMusicWithTheGivenId(): void
    {
        $mockedMusicAccessGateway = $this->getMockBuilder(MusicAccessGateway::class)
            ->setMethods(['save', 'findById'])
            ->getMock();

        $id = 1;
        $duration = 142;
        $title = "test song";
        $lyrics = "test lyrics for the test song";

        $music = new Music($duration, $title, $lyrics);
        $reflection = new \ReflectionClass(Music::class);
        $reflectionProperty = $reflection->getProperty("id");
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($music, $id);

        $mockedMusicAccessGateway->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn($music);

        $findMusicUseCase = new FindMusicUseCase($mockedMusicAccessGateway);
        $musicFoundResponseDto = $findMusicUseCase->findById($id);

        $this->assertEquals(
            $id,
            $musicFoundResponseDto->getId()
        );

        $this->assertEquals(
            $duration,
            $musicFoundResponseDto->getDurationInSeconds()
        );

        $this->assertEquals(
            $title,
            $musicFoundResponseDto->getTitle()
        );

        $this->assertEquals(
            $lyrics,
            $musicFoundResponseDto->getLyrics()
        );
    }

    public function testShouldReceiveAMusicNotFoundException(): void
    {
        $mockedMusicAccessGateway = $this->getMockBuilder(MusicAccessGateway::class)
            ->setMethods(['save', 'findById'])
            ->getMock();

        $id = 1;

        $mockedMusicAccessGateway->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willThrowException(new MusicNotFoundException());

        $this->expectException(MusicNotFoundException::class);

        $findMusicUseCase = new FindMusicUseCase($mockedMusicAccessGateway);
        $musicFoundResponseDto = $findMusicUseCase->findById($id);
    }
}