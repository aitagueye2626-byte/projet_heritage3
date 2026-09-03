<?php

namespace App\Model;

use PDO;
use DateTime;
use App\Entity\CopieExamen;
use App\Service\CalculNoteAvecRetardService;

class PdoCopieExamenRepository implements CopieExamenRepositoryInterface
{
    public function __construct(
        private PDO $pdo
    ) {
    }
}