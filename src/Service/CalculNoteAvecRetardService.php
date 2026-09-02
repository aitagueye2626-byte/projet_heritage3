<?php

namespace App\Service;

final class CalculNoteAvecRetardService implements CalculNoteInterface
{
    private const PENALITE_RETARD = 2.0;

   public function calculer(float $noteBrute, bool $penaliteAppliquee): float
{
    if (!$penaliteAppliquee) {
        return $noteBrute;
    }

    return max(0.0, $noteBrute - self::PENALITE_RETARD);
    }
}