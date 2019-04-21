<?php

namespace Mus\Music\Exception;

use Throwable;

class InvalidMusicDataException extends \Exception {
    private $violations;

    public function __construct(string $message, array $violations)
    {
        parent::__construct($message);
        $this->violations = $violations;
    }

    public function getViolations(): array
    {
        return $this->violations;
    }
}