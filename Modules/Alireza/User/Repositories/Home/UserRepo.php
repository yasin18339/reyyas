<?php

namespace Alireza\User\Repositories\Home;

use Alireza\Role\Models\Permission;
use Alireza\User\Models\User;

class UserRepo
{
    public function authors(){

        return $this->query()->permission(Permission::PERMISSION_AUTHORS)->latest();
    }

    public function findByName($name)
    {
        return $this->query()->whereName($name);
    }


    private function query(){


        return User::query();
    }



}
