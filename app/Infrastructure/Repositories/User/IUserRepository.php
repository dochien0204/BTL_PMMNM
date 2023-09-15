<?php

namespace App\Infrastructure\Repositories\User;

use App\UseCase\DataCommonFormatter;

interface IUserRepository {

    public function getAllUser(): DataCommonFormatter;
}