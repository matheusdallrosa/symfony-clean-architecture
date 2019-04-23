<?php

namespace Mus\Music\DataTransferObject;

use Mus\Music\Entity\Music;
use Mus\Music\Exception\MusicNotSavedException;
use PHPUnit\Framework\TestCase;

class CreateMusicResponseDtoTest extends TestCase {

    public function testShouldReceiveMusicDataFromGettersAndToArray(): void
    {
        $id = 1;
        $durationInSeconds = 223;
        $title = "ABCDEFGH ABCDEFGH ABCDEFGH";
        $lyrics = "ABCDEFGHABCDEFGHABCDEFGH ABCDEFGH ABCDEFGH ABCDEFGH ABCDEFGHABCDEFGH";
        $music = new Music(
            $durationInSeconds,
            $title,
            $lyrics
        );
        $reflection = new \ReflectionClass(Music::class);
        $reflectionProperty = $reflection->getProperty("id");
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($music, $id);

        $createMusicResponseDto = new CreateMusicResponseDto($music);

        $this->assertEquals(
            [
                'id' => $id,
                'durationInSeconds' => $durationInSeconds,
                'title' => $title,
                'lyrics' => $lyrics
            ],
            $createMusicResponseDto->toArray()
        );

        $this->assertEquals(
            $id,
            $createMusicResponseDto->getId()
        );

        $this->assertEquals(
            $durationInSeconds,
            $createMusicResponseDto->getDurationInSeconds()
        );

        $this->assertEquals(
            $title,
            $createMusicResponseDto->getTitle()
        );

        $this->assertEquals(
            $lyrics,
            $createMusicResponseDto->getLyrics()
        );
    }

    public function testShouldReceiveAnMusicNotSavedException(): void
    {
        $durationInSeconds = 223;
        $title = "ABCDEFGH ABCDEFGH ABCDEFGH";
        $lyrics = "ABCDEFGHABCDEFGHABCDEFGH ABCDEFGH ABCDEFGH ABCDEFGH ABCDEFGHABCDEFGH";
        $music = new Music(
            $durationInSeconds,
            $title,
            $lyrics
        );

        $this->expectException(MusicNotSavedException::class);

        $createMusicResponseDto = new CreateMusicResponseDto($music);
    }
}