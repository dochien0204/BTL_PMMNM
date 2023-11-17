<?php

namespace App\UseCase\Category;

use App\Infrastructure\Repositories\Category\ICategoryRepository;
use App\UseCase\DataCommonFormatter;

class CategoryService implements CategoryUseCase
{
    private ICategoryRepository $categoryRepo;

    public function __construct(ICategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getCategoryByCode(string $code): DataCommonFormatter
    {
        return $this->categoryRepo->getCategoryByCode($code);
    }

    public function getAllCategoryByType(string $type): DataCommonFormatter
    {
        return $this->categoryRepo->getAllCategoryByType($type);
    }
}
