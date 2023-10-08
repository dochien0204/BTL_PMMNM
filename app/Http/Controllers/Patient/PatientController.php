<?php

namespace App\Http\Controllers\Patient;

use App\Config\Message;
use App\Http\Controllers\Controller;
use App\Http\Presenter\Response;
use App\UseCase\Patient\PatientUseCase;
use App\Util\ExceptionHandler;
use App\Util\Pagination;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class PatientController extends Controller {

    public PatientUseCase $service;

    public function __construct(PatientUseCase $service)
    {
        $this->service = $service;
    }

    public function getAllPatient(Request $request) {
        $paginationParams = new Pagination($request);

        $patients = $this->service->getAllPatients(
            $paginationParams->getKeyWord(),
            $paginationParams->getPage(),
            $paginationParams->getPageSize(),
            $paginationParams->getSortBy(),
            $paginationParams->getSortType()
        );

        if ($patients->getException() != null) {
            return ExceptionHandler::CustomHandleException($patients->getException());
        }

        $count = $this->service->countAllPatients($paginationParams->getKeyWord());
        $paginationParams->setRecordCount($count);
        $paginationParams->setDisplayRecord($patients->getData()->count());
        return Response::BaseResponse(HttpResponse::HTTP_OK, Message::SUCCESS, $patients->getData());
    }
}