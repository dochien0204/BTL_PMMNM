<?php

namespace App\Http\Presenter\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class Presenter {

    public static function convertUserToPresenter(User $user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    public static function convertListUserToPresenter(Collection $listUser) {
        $dataConvert = $listUser->map(function($data) {
            return [
                'id' => $data->id,
                'name' => $data->name,
                'email' => $data->email,
            ];
        });

        return $dataConvert;
    }
}