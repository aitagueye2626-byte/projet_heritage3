<?php

namespace Tests;

// 1. Les require_once DOIVENT être placés APRÈS le namespace
$rootDir = dirname(__DIR__);

require_once $rootDir . '/src/Entity/AbstractDocument.php';
require_once $rootDir . '/src/Entity/CopieExamen.php';
require_once $rootDir . '/src/DTO/SoumettreCopieDTO.php';
require_once $rootDir . '/src/Repository/CopieExamenRepositoryInterface.php';
require_once $rootDir . '/src/Service/CalculNoteInterface.php';
require_once $rootDir . '/src/Service/SoumissionCopieService.php';

use App\DTO\SoumettreCopieDTO;
use App\Entity\CopieExamen;
use App\Repository\CopieExamenRepositoryInterface;
use App\Service\CalculNoteInterface;
use App\Service\SoumissionCopieService;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class SoumissionCopieServiceTest extends TestCase
{
    public function testSoumissionCopieSuccess(): void
    {
        $calculNoteMock = $this->createMock(CalculNoteInterface::class);
        $repositoryMock = $this->createMock(CopieExamenRepositoryInterface::class);

        $dto = new SoumettreCopieDTO(
            'Examen PHP',
            'Samba Diallo',
            16.0,
            new DateTimeImmutable('2026-09-03 10:00:00'),
            new DateTimeImmutable('2026-09-03 12:00:00')
        );

        $calculNoteMock->expects($this->once())
            ->method('calculer')
            ->willReturn(16.0);

        $repositoryMock->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(CopieExamen::class));

        $service = new SoumissionCopieService($calculNoteMock, $repositoryMock);
        $copie = $service->soumettre($dto);

        $this->assertInstanceOf(CopieExamen::class, $copie);
        $this->assertEquals(16.0, $copie->getNoteFinale());
    }
}