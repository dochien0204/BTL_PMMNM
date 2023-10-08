<?php

namespace App\Http\Controllers\Patient;

use App\Config\Constant;
use App\Models\Patient;
use App\Util\Common as UtilCommon;

class Common {

    public static function convertPatientPayloadToEntity(array $data) {
        $data = UtilCommon::convertKeysToCase(Constant::SNAKE_CASE, $data);
        $patient = new Patient();
        $patient->fill($data);
        return $patient;
    }
}