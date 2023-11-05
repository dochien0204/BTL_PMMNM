<?php

namespace App\Http\Payload\MedicalRegistrationForm;

class Payload {

    const CreateMedicalRegistrationFormPayload = [
        'patientId',
        'userId',
        'categoryId',
        'dayOfExamination',
        'reason'
    ];

    const ValidateCreateMedicalFormPayload = [
        'patientId' => 'required',
        'userId' => 'required',
        'categoryId' => 'required',
        'dayOfExamination' => 'required',
        'reason' => 'required'
    ];
}