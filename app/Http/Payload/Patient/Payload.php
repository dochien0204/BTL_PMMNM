<?php

namespace App\Http\Payload\Patient;

class Payload {

    const PatientPayload = [
        'name',
        'gender',
        'birthday',
        'phoneNumber',
        'address',
        'insuranceNumber'
    ];

    const ValidatePatientPayload = [
        'name' => 'required',
        'birthday' => 'required',
        'address' => 'required',
        'phoneNumber' => 'required',
    ];
}