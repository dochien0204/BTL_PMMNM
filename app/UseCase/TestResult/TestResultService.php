<?php

namespace App\UseCase\TestResult;

use App\Infrastructure\Define\Status;
use App\Infrastructure\Repositories\Fee\IFeeRepository;
use App\Infrastructure\Repositories\MedicalRegistrationForm\IMedicalRegistrationFormRepository;
use App\Infrastructure\Repositories\Status\IStatusRepository;
use App\Infrastructure\Repositories\TestResult\ITestResultRepository;
use App\Models\Fee;
use App\Models\MedicalRegistrationForm;
use App\Models\TestResult;
use App\UseCase\DataCommonFormatter;

class TestResultService implements TestResultUseCase {

    private ITestResultRepository $testResultRepo;
    private IFeeRepository $feeRepo;
    private IMedicalRegistrationFormRepository $medicalFormRepo;
    private IStatusRepository $statusRepo;

    public function __construct(ITestResultRepository $testResultRepo, IFeeRepository $feeRepo, IMedicalRegistrationFormRepository $medicalFormRepo, IStatusRepository $statusRepo)
    {
        $this->testResultRepo = $testResultRepo;
        $this->feeRepo = $feeRepo;
        $this->medicalFormRepo = $medicalFormRepo;
        $this->statusRepo = $statusRepo;
    }

    public function createTestResultFee(int $medicalFormId, TestResult $testResult): DataCommonFormatter {
        $medicalForm = $this->medicalFormRepo->getMedicalFormById($medicalFormId);
        if ($medicalForm->getException() != null) {
            return new DataCommonFormatter($medicalForm->getException(), null);
        }

        //Status unpaid
        $statusUnpaid = $this->statusRepo->getStatusByCode(Status::UNPAID);
        if ($statusUnpaid->getException() != null) {
            return new DataCommonFormatter($statusUnpaid->getException(), null);
        }

        //Create Fee
        $fee = new Fee();
        $fee->medical_registration_form_id = $medicalFormId;
        $fee->status_id = $statusUnpaid->getData()->id;
        $result = $this->feeRepo->createFee($fee);
        if ($result->getException() != null) {
            return new DataCommonFormatter($result->getException(), null);
        }

        $testResult->fee_id = $result->getData()->id;
        return $this->testResultRepo->createTestResult($testResult);
    }
}