<?php

namespace App\Http\Payload\Patient;

class Payload {

    const PatientPayload = [
        'patientGroup',
        'name',
        'birthday',
        'phoneNumber',
        'address'
    ];

    const ValidatePatientPayload = [
        'patientGroup' => 'required',
        'name' => 'required',
        'address' => 'required',
        'phoneNumber' => 'required'
    ];
}