<?php

namespace Alireza\Article\Policies;

use Alireza\Role\Models\Permission;
use Alireza\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;


    public function __construct()
    {

    }

    public function manage(User $user){

        if ($user->hasPermissionTo(Permission::PERMISSION_ARTICLES)){
            return true;
        }

    }
}
