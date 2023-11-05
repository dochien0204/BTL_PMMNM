<?php

namespace App\UseCase\MedicalRegistrationForm;

use App\Config\Constant;
use App\Infrastructure\Define\Status;
use App\Infrastructure\Repositories\Category\ICategoryRepository;
use App\Infrastructure\Repositories\MedicalRegistrationForm\IMedicalRegistrationFormRepository;
use App\Infrastructure\Repositories\Patient\IPatientRepository;
use App\Infrastructure\Repositories\User\IUserRepository;
use App\Models\MedicalRegistrationForm;
use App\UseCase\DataCommonFormatter;
use App\Util\Common;

class MedicalRegistrationFormService implements MedicalRegistrationFormUseCase {

    private IPatientRepository $patientRepo;
    private ICategoryRepository $categoryRepo;
    private IUserRepository $userRepo;
    private IMedicalRegistrationFormRepository $medicalFormRepo;

    public function __construct(IPatientRepository $patientRepo, ICategoryRepository $categoryRepo, IUserRepository $userRepo, IMedicalRegistrationFormRepository $medicalFormRepo)
    {
        $this->patientRepo = $patientRepo;
        $this->categoryRepo = $categoryRepo;
        $this->userRepo = $userRepo;
        $this->medicalFormRepo = $medicalFormRepo;
    }

    public function createMedicalRegistrationForm(array $data): DataCommonFormatter
    {
        $data = Common::convertKeysToCase(Constant::SNAKE_CASE, $data);
        //Check patient
        $patient = $this->patientRepo->getPatientById($data['patient_id']);
        if ($patient->getException() != null) {
            return new DataCommonFormatter($patient->getException(), null);
        }

        //Check user
        $doctor = $this->userRepo->findById($data['user_id']);
        if ($doctor->getException() != null) {
            return new DataCommonFormatter($doctor->getException(), null);
        }

        //Check category
        $category = $this->categoryRepo->findById($data['category_id']);
        if ($category->getException() != null) {
            return new DataCommonFormatter($category->getException(), null);
        }

        $medicalRegistrationForm = new MedicalRegistrationForm();
        $medicalRegistrationForm->fill($data);
        $medicalRegistrationForm->status = Status::WAITING_FOR_HEALTH_CHECK;
        return $this->medicalFormRepo->createMedicalRegistrationForm($medicalRegistrationForm);
    }
}