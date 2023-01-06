<?php

namespace Alireza\Role\Database\Seeders;

use Alireza\Role\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        foreach (Permission::$permissions as $permission){
            \Spatie\Permission\Models\Permission::findOrCreate($permission);

        }
    }
}
