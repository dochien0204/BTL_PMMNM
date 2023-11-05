<?php

namespace App\Infrastructure\Repositories\MedicalRegistrationForm;

use App\Exceptions\CustomExceptionHandler;
use App\Models\MedicalRegistrationForm;
use App\UseCase\DataCommonFormatter;
use Exception;

class MedicalRegistrationFormRepository implements IMedicalRegistrationFormRepository {

    public function createMedicalRegistrationForm(MedicalRegistrationForm $data): DataCommonFormatter
    {
        try {
            $data->save();
        } catch(Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }

        return new DataCommonFormatter(null, $data);
    }
}