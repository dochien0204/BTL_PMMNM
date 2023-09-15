<?php

namespace App\UseCase\User;

use App\UseCase\DataCommonFormatter;

interface UserUseCase {

    public function getAllUser(): DataCommonFormatter;
}