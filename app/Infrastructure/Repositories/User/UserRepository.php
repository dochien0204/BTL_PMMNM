<?php

namespace App\Infrastructure\Repositories\User;

use App\Exceptions\CustomExceptionHandler;
use App\Infrastructure\Repositories\EloquentRepository;
use App\Models\User;
use App\UseCase\DataCommonFormatter;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserRepository extends EloquentRepository implements IUserRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function getAllUser(): DataCommonFormatter
    {
        try {
            $listUser = $this->_model::all();
            if ($listUser == null) {
                return new DataCommonFormatter(CustomExceptionHandler::badRequest(), null);
            }
        } catch (Exception $exc) {
            return new DataCommonFormatter(CustomExceptionHandler::internalServerError(), null);
        }

        return new DataCommonFormatter(null, $listUser);
    }

    public function attempt(array $data)
    {
        return Auth::attempt($data);
    }

    public function createUser(array $data)
    {
        return $this->create($data);
    }

    public function findByEmail(string $email)
    {
        return $this->_model->where('email', $email)->first();
    }

    public function getDetailUser($id)
    {
        return $this->_model->find($id)->first();
    }

    public function updateUser($id, $dataUpdate)
    {
        return $this->_model->find($id)?->update($dataUpdate);
    }

    public function updatePassword($email, $password)
    {
        return $this->_model::where('email', $email)?->update(['password' => $password]);
    }
}
