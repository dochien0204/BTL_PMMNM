<?php

namespace App\Infrastructure\Repositories\MedicalRegistrationForm;

use App\Exceptions\CustomExceptionHandler;
use App\Models\MedicalRegistrationForm;
use App\UseCase\DataCommonFormatter;
use App\Util\Pagination;
use Exception;

class MedicalRegistrationFormRepository implements IMedicalRegistrationFormRepository {

    public function createMedicalRegistrationForm(MedicalRegistrationForm $data): DataCommonFormatter
    {
        try {
            $data->save();
        } catch(Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }

        return new DataCommonFormatter(null, $data);
    }

    public function getListMedicalRegistrationForm(int $page, int $pageSize, string $keyword, string $sortBy, string $sortType): DataCommonFormatter {
        try {
            $query = MedicalRegistrationForm::with(['doctor', 'patient', 'category']);
            $filterColumn = [];
            if (!empty($keyword) && !empty($filterColumn)) {
                $query->where($filterColumn[0], $keyword);
            }
            $query->orderBy($sortBy, $sortType);
            $offset = Pagination::calculateOffset($page, $pageSize);
            $query->offset($offset);
            $query->limit($pageSize);
            return new DataCommonFormatter(null, $query->get());
        } catch(Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }
    }

    public function countAllMedicalRegistrationForm(string $keyword): int {
        try {
            $query = MedicalRegistrationForm::query();
            $filterColumn = [];
            if (!empty($keyword) && !empty($filterColumn)) {
                $query->where($filterColumn[0], $keyword);
            }
            $filterColumn = [];
            if (!empty($keyword) && !empty($filterColumn)) {
                $query->where($filterColumn[0], $keyword);
            }
        } catch(Exception $e) {
            throw new Exception($e);
        }

        return $query->count();
    }
}