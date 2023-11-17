<?php

namespace App\Http\Controllers\Category;

use App\Config\Message;
use App\Exceptions\CustomExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Presenter\Response;
use App\UseCase\Category\CategoryUseCase;
use App\Util\ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class CategoryController extends Controller
{
    private CategoryUseCase $service;

    public function __construct(CategoryUseCase $service)
    {
        $this->service = $service;
    }

    public function getAllCategoryByType(Request $request)
    {
        $type = $request->query('type');
        if ($type == null) {
            return ExceptionHandler::CustomHandleException(CustomExceptionHandler::badRequest());
        }

        $results = $this->service->getAllCategoryByType($type);
        if ($results->getException() != null) {
            return ExceptionHandler::CustomHandleException($results->getException());
        }

        return Response::BaseResponse(HttpResponse::HTTP_OK, Message::SUCCESS, $results->getData());
    }
}
