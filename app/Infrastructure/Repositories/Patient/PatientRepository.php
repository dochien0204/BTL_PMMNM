<?php

namespace App\Infrastructure\Repositories\Patient;

use App\Exceptions\CustomExceptionHandler;
use App\Models\Patient;
use App\Models\User;
use App\UseCase\DataCommonFormatter;
use App\Util\Pagination;
use Exception;

class PatientRepository implements IPatientRepository
{

    public function getAllPatients(string $keyword, int $page, int $size, string $sortBy, string $sortType): DataCommonFormatter
    {
        try {
            $query = Patient::query();
            $filterColumn = [];
            if (!empty($keyword) && !empty($filterColumn)) {
                $query->where($filterColumn[0], $keyword);
            }
            $query->orderBy($sortBy, $sortType);
            $offset = Pagination::calculateOffset($page, $size);
            $query->offset($offset);
            $query->limit($size);
            return new DataCommonFormatter(null, $query->get());
        } catch(Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }
    }

    public function CountAllPatients(string $keyword): int {
        try {
            $query = Patient::query();
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