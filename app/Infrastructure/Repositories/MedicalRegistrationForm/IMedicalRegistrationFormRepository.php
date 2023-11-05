<?php

namespace App\Infrastructure\Repositories\MedicalRegistrationForm;

use App\Models\MedicalRegistrationForm;
use App\UseCase\DataCommonFormatter;

interface IMedicalRegistrationFormRepository {

    public function createMedicalRegistrationForm(MedicalRegistrationForm $data): DataCommonFormatter;
}