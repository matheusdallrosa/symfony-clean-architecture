<?php

namespace Mus\Music\DataTransferObject;

use PHPUnit\Framework\TestCase;

class CreateMusicRequestDtoTest extends TestCase {

    public function testShouldReceiveTheCorrectDataFromGettersWhenUsingDefaultConstructor(): void
    {

        $durationInSeconds = 123123;
        $title = 'this is a title only for tests, it is really boring to make data for testing...';
        $lyrics = 'this is the lyrics of the song';

        $createMusicDto = new CreateMusicRequestDto($durationInSeconds, $title, $lyrics);

        $this->assertEquals(
            $durationInSeconds,
            $createMusicDto->getDurationInSeconds()
        );

        $this->assertEquals(
            $title,
            $createMusicDto->getTitle()
        );

        $this->assertEquals(
            $lyrics,
            $createMusicDto->getLyrics()
        );
    }

    public function testShouldReceiveTheCorrectDataFromGettersWhenUsingFromArray(): void
    {

        $data = [
            'durationInSeconds' => 123123,
            'title' => 'this is a title only for tests, it is really boring to make data for testing...',
            'lyrics' => 'this is the lyrics of the song'
        ];

        $createMusicDto = CreateMusicRequestDto::fromArray($data);

        $this->assertEquals(
            $data['durationInSeconds'],
            $createMusicDto->getDurationInSeconds()
        );

        $this->assertEquals(
            $data['title'],
            $createMusicDto->getTitle()
        );

        $this->assertEquals(
            $data['lyrics'],
            $createMusicDto->getLyrics()
        );
    }

    public function testShouldReceiveTheCorrectDataFromToArrayWhenUsingDefaultConstructor(): void
    {

        $durationInSeconds = 123123;
        $title = 'this is a title only for tests, it is really boring to make data for testing...';
        $lyrics = 'this is the lyrics of the song';

        $createMusicDto = new CreateMusicRequestDto($durationInSeconds, $title, $lyrics);

        $this->assertEquals(
            [
                'durationInSeconds' => $durationInSeconds,
                'title' => $title,
                'lyrics' => $lyrics
            ],
            $createMusicDto->toArray()
        );
    }

    public function testShouldReceiveTheCorrectDataFromToArrayWhenUsingFromArray(): void
    {

        $data = [
            'durationInSeconds' => 123123,
            'title' => 'this is a title only for tests, it is really boring to make data for testing...',
            'lyrics' => 'this is the lyrics of the song'
        ];

        $createMusicDto = CreateMusicRequestDto::fromArray($data);

        $this->assertEquals(
            $data,
            $createMusicDto->toArray()
        );
    }
}