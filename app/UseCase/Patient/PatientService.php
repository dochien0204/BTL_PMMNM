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
}