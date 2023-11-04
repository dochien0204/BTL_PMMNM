<?php

namespace App\Http\Payload\Medicine;

class Payload {

    const MedicinePayload = [
        'name',
        'code',
        'expiredDate',
        'manufacturedDate',
        'publisher',
        'instruction',
        'ingredient',
        'unit',
        'price'
    ];

    const ValidateMedicinePayload = [
        'name' => 'required',
        'code' => 'required',
        'expiredDate' => 'required',
        'manufacturedDate' => 'required',
        'publisher' => 'required',
        'instruction' => 'required',
        'ingredient' => 'required',
        'unit' => 'required',
        'price' => 'required'
    ];
}