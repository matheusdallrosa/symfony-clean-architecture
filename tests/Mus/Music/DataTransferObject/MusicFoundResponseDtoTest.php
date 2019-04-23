<?php

namespace Mus\Music\DataTransferObject;

use Mus\Music\Entity\Music;
use Mus\Music\Exception\MusicNotSavedException;
use PHPUnit\Framework\TestCase;

class MusicFoundResponseDtoTest extends TestCase {

    public function testShouldReceiveMusicDataFromGettersAndToArray(): void
    {
        $id = 1;
        $durationInSeconds = 1212;
        $title = "asda asda sdASDASd adASDASd ASDASDAS";
        $lyrics = "AdasdADSASdsad asdASDaSd! ASDADS!asdasd!!H";
        $music = new Music(
            $durationInSeconds,
            $title,
            $lyrics
        );
        $reflection = new \ReflectionClass(Music::class);
        $reflectionProperty = $reflection->getProperty("id");
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($music, $id);

        $createMusicResponseDto = new MusicFoundResponseDto($music);

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
        $durationInSeconds = 1212;
        $title = "asda asda sdASDASd adASDASd ASDASDAS";
        $lyrics = "AdasdADSASdsad asdASDaSd! ASDADS!asdasd!!H";
        $music = new Music(
            $durationInSeconds,
            $title,
            $lyrics
        );

        $this->expectException(MusicNotSavedException::class);

        $createMusicResponseDto = new MusicFoundResponseDto($music);
    }
}
