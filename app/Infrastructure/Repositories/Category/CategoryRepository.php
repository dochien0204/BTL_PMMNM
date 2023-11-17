<?php

namespace App\Infrastructure\Repositories\Category;

use App\Exceptions\CustomExceptionHandler;
use App\Models\Category;
use App\UseCase\DataCommonFormatter;
use Exception;

class CategoryRepository implements ICategoryRepository
{
    public function getCategoryByCode(string $code): DataCommonFormatter
    {
        try {
            $data = Category::where('code', $code)->first();
            if ($data == null) {
                return new DataCommonFormatter(CustomExceptionHandler::badRequest(), null);
            }
        } catch (Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }

        return new DataCommonFormatter(null, $data);
    }

    public function getAllCategoryByType(string $type): DataCommonFormatter
    {
        try {
            $categories = Category::where('type', $type);
        } catch (Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }

        return new DataCommonFormatter(null, $categories->get());
    }

    public function findById(int $id): DataCommonFormatter {
        try {
            $data = Category::where('id', $id)->first();
            if ($data == null) {
                return new DataCommonFormatter(CustomExceptionHandler::badRequest(), null);
            }
        } catch (Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }

        return new DataCommonFormatter(null, $data);
    }
}
