<?php

namespace Alireza\Role\Http\Controllers;

use Alireza\Role\Http\Requests\RoleRequest;
use Alireza\Role\Models\Role;
use Alireza\Role\Repositories\PermissionRepo;
use Alireza\Role\Repositories\RoleRepo;
use Alireza\Role\Services\RoleService;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public RoleRepo  $repo;
    public RoleService  $service;

    public function __construct(RoleRepo $roleRepo, RoleService $roleService)
    {
        $this->repo = $roleRepo;
        $this->service = $roleService;
    }

    public function index()
    {   $this->authorize('index', Role::class);
        $roles = $this->repo->index()->with('permissions')->paginate(10);
        return view('Role::index', compact('roles'));
    }


    public function create(PermissionRepo $permissionRepo)
    {   $this->authorize('index', Role::class);
        $permissions = $permissionRepo->all();
        return view('Role::create', compact('permissions'));
    }


    public function store(RoleRequest $request)
    {   $this->authorize('index', Role::class);
        $this->service->store($request);

        alert()->success('ساخت مقام', 'مقام با موفقیت ساخته شد');
        return redirect()->route('roles.index');
    }


    public function edit($id,PermissionRepo $permissionRepo)
    {   $this->authorize('index', Role::class);
        $role = $this->repo->findById($id);
        $permissions = $permissionRepo->all();
        return view('Role::edit', compact(['role', 'permissions']));
    }


    public function update(RoleRequest $request, $id)
    {   $this->authorize('index', Role::class);
        $this->service->update($request, $id);
        alert()->success('ویرایش مقام', 'مقام با موفقیت ویرایش شد');
        return redirect()->route('roles.index');
    }


    public function destroy($id)
    {   $this->authorize('index', Role::class);
        $this->repo->delete($id);
        alert()->success('حذف مقام', 'مقام با موفقیت حذف شد');
        return redirect()->route('roles.index');
    }
}
