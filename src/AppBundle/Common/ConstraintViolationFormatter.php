<?php

namespace AppBundle\Common;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ConstraintViolationFormatter {
    public static function format(ConstraintViolationListInterface $violations){
        $violationsMessages = [];
        foreach ($violations as $violation){
            $path = $violation->getPropertyPath();
            $violationsMessages[$path] = $violationsMessages[$path] ?? [];
            $violationsMessages[$path][] = $violation->getMessage();
        }
        return $violationsMessages;
    }
}