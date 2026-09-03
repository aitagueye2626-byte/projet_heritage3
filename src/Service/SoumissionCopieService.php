<?php

namespace App\Service;

use App\DTO\SoumettreCopieDTO;
use App\Entity\CopieExamen;
use App\Repository\CopieExamenRepositoryInterface;

class SoumissionCopieService
{
    private CalculNoteInterface $calculNoteService;
    private CopieExamenRepositoryInterface $copieRepository;

    public function __construct(
        CalculNoteInterface $calculNoteService,
        CopieExamenRepositoryInterface $copieRepository
    ) {
        $this->calculNoteService = $calculNoteService;
        $this->copieRepository = $copieRepository;
    }
}