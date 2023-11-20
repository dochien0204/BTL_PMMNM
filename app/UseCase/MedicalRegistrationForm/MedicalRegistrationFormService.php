<?php

namespace App\UseCase\MedicalRegistrationForm;

use App\Config\Constant;
use App\Infrastructure\Define\Status;
use App\Infrastructure\Repositories\Category\ICategoryRepository;
use App\Infrastructure\Repositories\MedicalRegistrationForm\IMedicalRegistrationFormRepository;
use App\Infrastructure\Repositories\Patient\IPatientRepository;
use App\Infrastructure\Repositories\Status\IStatusRepository;
use App\Infrastructure\Repositories\User\IUserRepository;
use App\Models\MedicalRegistrationForm;
use App\UseCase\DataCommonFormatter;
use App\Util\Common;

class MedicalRegistrationFormService implements MedicalRegistrationFormUseCase {

    private IPatientRepository $patientRepo;
    private ICategoryRepository $categoryRepo;
    private IUserRepository $userRepo;
    private IMedicalRegistrationFormRepository $medicalFormRepo;
    private IStatusRepository $statusRepo;

    public function __construct(IPatientRepository $patientRepo, ICategoryRepository $categoryRepo, IUserRepository $userRepo, IMedicalRegistrationFormRepository $medicalFormRepo, IStatusRepository $statusRepo)
    {
        $this->patientRepo = $patientRepo;
        $this->categoryRepo = $categoryRepo;
        $this->userRepo = $userRepo;
        $this->medicalFormRepo = $medicalFormRepo;
        $this->statusRepo = $statusRepo;
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

        //Get default status medical registration form 
        $statusDefault = $this->statusRepo->getStatusByCode(Status::WAITING_FOR_HEALTH_CHECK);
        if ($statusDefault->getException() != null) {
            return new DataCommonFormatter($statusDefault->getException(), null);
        }

        $medicalRegistrationForm = new MedicalRegistrationForm();
        $medicalRegistrationForm->code = Constant::DEFAULT_CODE;
        $medicalRegistrationForm->status_id = $statusDefault->getData()->id;
        $medicalRegistrationForm->fill($data);
        return $this->medicalFormRepo->createMedicalRegistrationForm($medicalRegistrationForm);
    }

    public function getListMedicalRegistrationForm(int $page, int $pageSize, string $keyword, string $sortBy, string $sortType): DataCommonFormatter
    {
        return $this->medicalFormRepo->getListMedicalRegistrationForm($page, $pageSize, $keyword, $sortBy, $sortType);
    }
    
    public function countAllMedicalRegistrationForm(string $keyword): int
    {
        return $this->medicalFormRepo->countAllMedicalRegistrationForm($keyword);
    }

    public function updateStatusMedicalForm(int $id, string $statusCode): DataCommonFormatter
    {
        //Get master data status
        $status = $this->statusRepo->getStatusByCode($statusCode);
        if ($status->getException() != null) {
            return new DataCommonFormatter($status->getException(), null);
        }

        return $this->medicalFormRepo->updateStatusMedicalForm($id, $status->getData()->id);
    }
}