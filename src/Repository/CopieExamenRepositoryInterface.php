<?php

namespace src\Repositorie;

use src\Entity\CopieExamen;

interface CopieExamenRepositoryInterface
{
    public function save(CopieExamen $copieExamen): CopieExamen;

    public function findAll(): array;

    public function findById(int $id): ?CopieExamen;
}