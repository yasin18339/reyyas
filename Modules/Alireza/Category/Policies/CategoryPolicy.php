<?php

namespace Alireza\Category\Policies;

use Alireza\Role\Models\Permission;
use Alireza\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }
    public function index(User $user){
        if ($user->hasPermissionTo(Permission::PERMISSION_CATEGORIES)){
            return true;
        }
    }
}
