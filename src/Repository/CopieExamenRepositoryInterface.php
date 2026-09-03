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

    public function save(CopieExamen $copie): CopieExamen
    {
        $sql = "
            INSERT INTO copie_examen (
                date_depot,
                note_brute,
                note_finale,
                penalite_appliquee,
                date_limite
            )
            VALUES (
                :date_depot,
                :note_brute,
                :note_finale,
                :penalite_appliquee,
                :date_limite
            )
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ':date_depot' => $copie->getDateDepot()
                ->format('Y-m-d H:i:s'),

            ':note_brute' => $copie->getNoteBrute(),

            ':note_finale' => $copie->getNoteFinale(),

            ':penalite_appliquee' => $copie->isPenaliteAppliquee(),

            ':date_limite' => $copie->getDateLimite()
                ->format('Y-m-d H:i:s'),
        ]);

        return $copie;
    }

    public function findAll(): array
    {
        $sql = "
            SELECT *
            FROM copie_examen
            ORDER BY id
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        $resultats = $statement->fetchAll(PDO::FETCH_ASSOC);

        $copies = [];

        foreach ($resultats as $resultat) {
            $copies[] = $this->mapperCopie($resultat);
        }

        return $copies;
    }

    public function findById(int $id): ?CopieExamen
    {
        $sql = "
            SELECT *
            FROM copie_examen
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->execute([
            ':id' => $id
        ]);

        $resultat = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$resultat) {
            return null;
        }

        return $this->mapperCopie($resultat);
    }

    private function mapperCopie(array $data): CopieExamen
    {
        return new CopieExamen(
            new DateTime($data['date_depot']),
            (float) $data['note_brute'],
            (bool) $data['penalite_appliquee'],
            new DateTime($data['date_limite']),
            new CalculNoteAvecRetardService(),
            (int) $data['id']
        );
    }
}