<?php

namespace Mus\Music\DataTransferObject;

class CreateMusicRequestDto extends MusicDto {
    public function __construct(int $durationInSeconds, string $title, string $lyrics)
    {
        $this->durationInSeconds = $durationInSeconds;
        $this->title = $title;
        $this->lyrics = $lyrics;
    }

    public static function fromArray(array $data): CreateMusicRequestDto
    {
        return new CreateMusicRequestDto(
            $data['durationInSeconds'],
            $data['title'],
            $data['lyrics']
        );
    }
}
