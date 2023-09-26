<?php

namespace App\UseCase\User;

use App\Infrastructure\Repositories\User\IUserRepository;
use App\UseCase\DataCommonFormatter;

class UserService implements UserUseCase
{
    private IUserRepository $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUser(): DataCommonFormatter
    {
        return $this->userRepo->getAllUser();
    }
}
