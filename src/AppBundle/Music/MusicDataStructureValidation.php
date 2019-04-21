<?php

namespace AppBundle\Music;

use Symfony\Component\Validator\Constraints;

class MusicDataStructureValidation {

    /**
     * @Constraints\Type(type="integer")
     * @Constraints\Range(min=1)
     */
    private $durationInSeconds;

    /**
     * @Constraints\Type(type="string")
     * @Constraints\NotBlank
     */
    private $title;

    /**
     * @Constraints\Type(type="string")
     * @Constraints\NotBlank
     */
    private $lyrics;

    public function __construct(array $musicData)
    {
        $this->durationInSeconds = $musicData['durationInSeconds'] ?? null;
        $this->title = $musicData['title'] ?? null;
        $this->lyrics = $musicData['lyrics'] ?? null;
    }

}