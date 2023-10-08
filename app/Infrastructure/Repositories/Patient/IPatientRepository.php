<?php

namespace App\Infrastructure\Repositories\Patient;

use App\UseCase\DataCommonFormatter;

interface IPatientRepository {

    public function getAllPatients(string $keyword, int $page, int $size, string $sortBy, string $sortType): DataCommonFormatter;
    public function CountAllPatients(string $keyword): int;
}