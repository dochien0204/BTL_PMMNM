<?php

namespace App\UseCase\Medicine;

use App\Infrastructure\Repositories\Medicine\IMedicineRepository;
use App\Models\Medicine;
use App\UseCase\DataCommonFormatter;

class MedicineService implements MedicineUseCase {

    private IMedicineRepository $medicineRepo;

    public function __construct(IMedicineRepository $medicineRepo)
    {
        $this->medicineRepo = $medicineRepo;
    }

    public function getAllMedicines(string $keyword, int $page, int $size, string $sortBy, string $sortType): DataCommonFormatter
    {
        return $this->medicineRepo->getAllMedicines($keyword, $page, $size, $sortBy, $sortType);
    }

    public function getMedicineById(int $id): DataCommonFormatter
    {
        return $this->medicineRepo->getMedicineById($id);
    }

    public function CountAllMedicines(string $keyword): int
    {
        return $this->medicineRepo->CountAllMedicines($keyword);
    }

    public function createMedicine(Medicine $data): DataCommonFormatter
    {
        return $this->medicineRepo->createMedicine($data);
    }

    public function deleteMedicineById(int $id): DataCommonFormatter
    {
        return $this->medicineRepo->deleteMedicineById($id);
    }

}