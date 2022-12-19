<?php

namespace Alireza\User\Services;

use Alireza\User\Models\User;

class UserService
{
    public function store($request){
        return User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);
    }
    public function update($request, $id){
        return User::query()->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),


        ]);

    }


}
