<?php

namespace App\Http\Controllers\MedicalRegistrationForm;

use App\Models\User;
use App\Util\Pagination;
use Illuminate\Database\Eloquent\Collection;

class Common {

    public static function convertToListMedicalRegistrationFormPagination(Pagination $pagination, Collection $listData) {
        $listDataConvert = $listData->map(function($item) {
            $doctor = $item->doctor();
            $patient = $item->patient();
            $category = $item->category();
            return [
                'id' => $item->id,
                'code' => $item->code,
                'dayOfExamination' => $item->day_of_examination,
                'reason' => $item->reason,
                'doctor' => [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                    'phoneNumber' => $doctor->phone_number,
                    'address' => $doctor->address,
                    'email' => $doctor->email,
                    'role' => $doctor->role
                ],
                'patient' => [
                    'id' => $patient->id,
                    'patientGroup' => $patient->patient_group,
                    'name' => $patient->name,
                    'gender' => $patient->gender,
                    'birthday' => $patient->birthday,
                    'phoneNumber' => $patient->phone_number,
                    'address' => $patient->address,
                    'insuranceNumber'=> $patient->insurance_number
                ],
                'category' => [
                    'id' => $category->id,
                    'code' => $category->code,
                    'name' => $category->name,
                    'type' => $category->type,
                    'description' => $category->description,
                ],
            ];
        });

        $dataPaging = [
            'count' => $pagination->getRecordCount(),
            'numPages' => ceil($pagination->getRecordCount() / $pagination->getPageSize()),
            'displayRecord' => $pagination->getDisplayRecord(),
            'page' => $pagination->getPage()
        ];

        return [
            'results' => $listDataConvert,
            'pagination' => $dataPaging
        ];
    }

    public static function convertUserToPresenter(User $data) {
        return [
            'id' => $data->id,
            'name' => $data->name,
            'phoneNumber' => $data->phone_number,
            'address' => $data->address,
            'email' => $data->email,
            'role' => $data->role
        ];
    }
}