<?php

namespace App\UseCase\Patient;

use App\Infrastructure\Repositories\Patient\IPatientRepository;
use App\Models\Patient;
use App\UseCase\DataCommonFormatter;

class PatientService implements PatientUseCase {

    protected IPatientRepository $patientRepo;

    public function __construct(IPatientRepository $patientRepo)
    {
        $this->patientRepo = $patientRepo;
    }

    public function getAllPatients(string $keyword, int $page, int $size, string $sortBy, string $sortType): DataCommonFormatter
    {
        return $this->patientRepo->getAllPatients($keyword, $page, $size, $sortBy, $sortType);
    }

    public function countAllPatients(string $keyword): int
    {
        return $this->patientRepo->countAllPatients($keyword);
    }

    public function getPatientById(int $id): DataCommonFormatter
    {
        return $this->patientRepo->getPatientById($id);
    }

    public function createPatient(Patient $patient): DataCommonFormatter
    {
        return $this->patientRepo->createPatient($patient);
    }

    public function deletePatientById(int $id): DataCommonFormatter
    {
        return $this->patientRepo->deletePatientById($id);
    }

    public function updatePatient(array $data): DataCommonFormatter
    {
        $patient = $this->patientRepo->getPatientById($data['id']);
        if ($patient->getException() != null) {
            return new DataCommonFormatter($patient->getException(), null);
        }

        $patientUpdate = $patient->getData();
        $patientUpdate->name = $data['name'];
        $patientUpdate->phone_number = $data['phone_number'];
        $patientUpdate->address = $data['address'];
        $patientUpdate->gender = $data['gender'];
        $patientUpdate->insurance_number = $data['insurance_number'];

        return $this->patientRepo->updatePatient($patientUpdate);
    }
}