<?php

namespace Alireza\Role\Policies;

use Alireza\Role\Models\Permission;
use Alireza\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }
    public function index(User $user){
        if ($user->hasPermissionTo(Permission::PERMISSION_ROLES)){
            return true;
        }
    }
}
