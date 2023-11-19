<?php

namespace App\Infrastructure\Repositories\MedicalRegistrationForm;

use App\Models\MedicalRegistrationForm;
use App\UseCase\DataCommonFormatter;

interface IMedicalRegistrationFormRepository {

    public function createMedicalRegistrationForm(MedicalRegistrationForm $data): DataCommonFormatter;
    public function getListMedicalRegistrationForm(int $page, int $pageSize, string $keyword, string $sortBy, string $sortType): DataCommonFormatter;
    public function countAllMedicalRegistrationForm(string $keyword): int;
}