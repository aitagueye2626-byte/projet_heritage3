<?php

namespace  App\DTO;

use App\Service\NoteValidator;
use App\Service\DateUtils;

readonly class SoumettreCopieDTO
{
    public float $noteBrute;
    public \DateTimeImmutable $dateDepot;
    public \DateTimeImmutable $dateLimite;

    private function __construct(
        float|string|null $noteBrute,
        string|null $dateDepot,
        string|null $dateLimite
    ) {
        $this->noteBrute = NoteValidator::validate($noteBrute);
        $this->dateDepot = DateUtils::convertirDate($dateDepot, 'date de dépôt');
        $this->dateLimite = DateUtils::convertirDate($dateLimite, 'date limite');
    }

    public static function fromArray(array $data): SoumettreCopieDTO
    {
        return new SoumettreCopieDTO(
            $data['note_brute'] ?? null,
            $data['date_depot'] ?? null,
            $data['date_limite'] ?? null
        );
    }
}