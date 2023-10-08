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

    public function getPatientById(int $id): DataCommonFormatter
    {
        try {
            $data = Patient::find($id);
            if ($data == null) {
                return new DataCommonFormatter(CustomExceptionHandler::badRequest(), null);
            }
            return new DataCommonFormatter(null, $data);
        } catch (Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }
    }

    public function createPatient(Patient $data): DataCommonFormatter
    {
        try {
            $data->save();
        } catch (Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }

        return new DataCommonFormatter(null, $data);
    }

    public function deletePatientById(int $id): DataCommonFormatter
    {
        try {
            $patient = Patient::find($id);
            if ($patient == null) {
                return new DataCommonFormatter(CustomExceptionHandler::badRequest(), null);
            }
            $patient->delete();
            return new DataCommonFormatter(null, $patient);
        } catch (Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }
    }
}