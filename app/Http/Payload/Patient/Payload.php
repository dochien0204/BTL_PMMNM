<?php

namespace App\Http\Payload\Patient;

class Payload {

    const PatientPayload = [
        'name',
        'gender',
        'birthday',
        'phoneNumber',
        'address',
        'insurance_number'
    ];

    const ValidatePatientPayload = [
        'name' => 'required',
        'birthday' => 'required',
        'address' => 'required',
        'phoneNumber' => 'required',
    ];
}