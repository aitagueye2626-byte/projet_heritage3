<?php

namespace App\Entity;

use DateTime;

abstract class AbstractDocument
{
    protected ?int $id;
    protected DateTime $dateDepot;

    protected function __construct(DateTime $dateDepot, ?int $id = null)
    {
        $this->dateDepot = $dateDepot;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepot(): DateTime
    {
        return $this->dateDepot;
    }

    public function setDateDepot(DateTime $dateDepot): void
    {
        $this->dateDepot = $dateDepot;
    }
}