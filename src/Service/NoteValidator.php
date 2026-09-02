<?php

namespace App\Service;

final class NoteValidator
{
    private function __construct()
    {
    }

    public static function validate(float|string|null $noteBrute): float
    {
        if ($noteBrute === null || $noteBrute === '' || !is_numeric($noteBrute)) {
            throw new \InvalidArgumentException('La note brute doit être une valeur numérique valide.');
        }

        $noteFloat = (float) $noteBrute;

        if ($noteFloat < 0.0 || $noteFloat > 20.0) {
            throw new \InvalidArgumentException(
                sprintf('La note brute doit être comprise entre 0 et 20 (valeur reçue : %.2f).', $noteFloat)
            );
        }

        return $noteFloat;
    }
}