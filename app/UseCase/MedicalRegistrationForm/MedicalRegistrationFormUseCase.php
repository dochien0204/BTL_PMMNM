<?php

namespace App\UseCase\MedicalRegistrationForm;

use App\UseCase\DataCommonFormatter;

interface MedicalRegistrationFormUseCase {

    public function createMedicalRegistrationForm(array $data): DataCommonFormatter;
}