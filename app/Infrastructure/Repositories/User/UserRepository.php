<?php

namespace App\Infrastructure\Repositories\User;

use App\Exceptions\CustomExceptionHandler;
use App\Models\User;
use App\UseCase\DataCommonFormatter;
use Exception;

class UserRepository implements IUserRepository
{
    public function getAllUser(): DataCommonFormatter
    {
        try {
            $listUser = User::all();
            if ($listUser == null) {
                return new DataCommonFormatter(CustomExceptionHandler::badRequest(), null);
            }
        } catch (Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }

        return new DataCommonFormatter(null, $listUser);
    }
}
