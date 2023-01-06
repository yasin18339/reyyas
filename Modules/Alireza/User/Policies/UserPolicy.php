<?php

namespace Alireza\User\Policies;

use Alireza\Role\Models\Permission;
use Alireza\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }
    public function index(User $user){
        if ($user->hasPermissionTo(Permission::PERMISSION_USERS)){
            return true;
        }
    }
}
