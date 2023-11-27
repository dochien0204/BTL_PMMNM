<?php

namespace App\Infrastructure\Repositories\Category;

use App\UseCase\DataCommonFormatter;

interface ICategoryRepository
{
    public function getCategoryByCode(string $code): DataCommonFormatter;

    public function getAllCategoryByType(string $type): DataCommonFormatter;

    public function findById(int $id): DataCommonFormatter;
}
