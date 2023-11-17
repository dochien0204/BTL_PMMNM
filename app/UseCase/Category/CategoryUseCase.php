<?php

namespace App\UseCase\Category;

use App\UseCase\DataCommonFormatter;

interface CategoryUseCase
{
    public function getCategoryByCode(string $code): DataCommonFormatter;

    public function getAllCategoryByType(string $type): DataCommonFormatter;
}
