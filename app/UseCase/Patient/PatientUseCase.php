<?php

namespace App\UseCase\Patient;

use App\UseCase\DataCommonFormatter;

interface PatientUseCase 
{

    public function getAllPatients(string $keyword, int $page, int $size, string $sortBy, string $sortType): DataCommonFormatter;
    public function countAllPatients(string $keyword): int;
}