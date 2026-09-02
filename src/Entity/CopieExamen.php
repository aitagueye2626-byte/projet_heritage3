<?php

namespace App\Entity;

use DateTime;
use App\Service\CalculNoteInterface;

class CopieExamen extends AbstractDocument
{
    private float $noteBrute;
    private float $noteFinale;
    private bool $penaliteAppliquee;
    private \DateTime $dateLimite;
    private CalculNoteInterface $calculNote;

    public function __construct(
        DateTime $dateDepot,
        float $noteBrute,
        bool $penaliteAppliquee,
        DateTime $dateLimite,
        CalculNoteInterface $calculNote,
        ?int $id = null
    ) {
        parent::__construct($dateDepot, $id);

        $this->verifierNote($noteBrute);
        $this->noteBrute = $noteBrute;
        $this->penaliteAppliquee = $penaliteAppliquee;
        $this->dateLimite = $dateLimite;
        $this->calculNote = $calculNote;

        $this->calculerNoteFinale();
    }

    public function calculerNoteFinale(): void
    {
        $this->noteFinale = $this->calculNote->calculer(
            $this->noteBrute,
            $this->penaliteAppliquee
        );
    }

    public function getNoteBrute(): float
    {
        return $this->noteBrute;
    }

    public function setNoteBrute(float $noteBrute): void
    {
        $this->verifierNote($noteBrute);
        $this->noteBrute = $noteBrute;
        $this->calculerNoteFinale();
    }

    public function getNoteFinale(): float
    {
        return $this->noteFinale;
    }

    public function isPenaliteAppliquee(): bool
    {
        return $this->penaliteAppliquee;
    }

    public function setPenaliteAppliquee(bool $penaliteAppliquee): void
    {
        $this->penaliteAppliquee = $penaliteAppliquee;
        $this->calculerNoteFinale();
    }

    public function getDateLimite(): DateTime
    {
        return $this->dateLimite;
    }

    public function setDateLimite(DateTime $dateLimite): void
    {
        $this->dateLimite = $dateLimite;
    }

    private function verifierNote(float $note): void
    {
        if ($note < 0 || $note > 20) {
            throw new \InvalidArgumentException(
                'La note doit être comprise entre 0 et 20.'
            );
        }
    }
}