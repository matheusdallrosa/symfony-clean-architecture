<?php

namespace Tests\Mus\Music\Entiy;

use Mus\Music\Entity\Music;
use Mus\Music\Exception\InvalidMusicDataException;
use PHPUnit\Framework\TestCase;

class MusicTest extends TestCase {

    public function testShouldReceiveTheCorrectDataFromTheGetters(): void
    {
        $durationInSeconds = 267;
        $title = "Ize Of The World";
        $lyrics = "I think i know what you mean but watch what you say....";
        $music = new Music(
            $durationInSeconds,
            $title,
            $lyrics
        );

        $this->assertEquals(null, $music->getId());
        $this->assertEquals($durationInSeconds, $music->getDurationInSeconds());
        $this->assertEquals($title, $music->getTitle());
        $this->assertEquals($lyrics, $music->getLyrics());
    }

    public function testShouldReceiveAnInvalidMusicDataException(): void
    {
        $durationInSeconds = -1;
        $title = "";
        $lyrics = "";

        $this->expectException(InvalidMusicDataException::class);

        $music = new Music($durationInSeconds, $title, $lyrics);
    }

    public function testShouldReceiveAnInvalidMusicDataExceptionWithTheCorrectViolations(): void
    {
        $durationInSeconds = -1;
        $title = "";
        $lyrics = "";

        $violations = [];
        $violations['duration'] = 'The duration must be an integer greater than 0.';
        $violations['title'] = 'The title must not be empty.';
        $violations['lyrics'] = 'The lyrics must not be empty.';

        try{
            $music = new Music($durationInSeconds, $title, $lyrics);
        }catch(InvalidMusicDataException $e){
            $this->assertEquals(
                $violations,
                $e->getViolations()
            );
        }
    }
}