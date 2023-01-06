<?php

namespace Alireza\User\Http\Controllers;

use Alireza\Role\Repositories\RoleRepo;
use Alireza\User\Http\Requests\AddRoleRequest;
use Alireza\User\Http\Requests\UserRequest;
use Alireza\User\Http\Requests\UserUpdateRequest;
use Alireza\User\Models\User;
use Alireza\User\Repositories\UserRepo;
use Alireza\User\Services\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public UserRepo $repo;
    public UserService $service;

    public function __construct(UserRepo $userRepo, UserService $userService)
    {
        $this->repo = $userRepo;
        $this->service = $userService;
    }

    public function index(){
    $this->authorize('index', User::class);
        $users = $this->repo->index();
        return view('User::index', compact('users'));
    }


    public function create()
    {$this->authorize('index', User::class);
        return view('User::create');
    }


    public function store(UserRequest $request)
    {$this->authorize('index', User::class);
        $this->service->store($request);
        return redirect()->route('users.index');


    }

    public function edit($id)
    {$this->authorize('index', User::class);
        $user = $this->repo->findById($id);
        return view('User::edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {$this->authorize('index', User::class);
        $this->service->update($request, $id);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {$this->authorize('index', User::class);
        $this->repo->delete($id);
        return redirect()->route('users.index')->with(['success_delete' => 'کابر با موفقیت حذف شد']);
    }

    public function addRole($user_id, RoleRepo $roleRepo){
        $this->authorize('index', User::class);
        $roles = $roleRepo->index()->get();
        return view('User::add-roles', compact(['user_id', 'roles']));

    }
    public function addRoleStore(AddRoleRequest $request, $userId){
        $this->authorize('index', User::class);
        $user = $this->repo->findById($userId);
        $this->service->addRole($request->role, $user);

        alert()->success('اضافه کردن مقام به کاربر', 'عملیات با موفقیت انجام شد');
        return redirect()->route('users.index');

    }
    public function removeRole($userId, $roleId, RoleRepo $roleRepo){
        $this->authorize('index', User::class);
        $user = $this->repo->findById($userId);
        $role = $roleRepo->findById($roleId);
        $this->service->deleteRole($user, $role->name);

        alert()->success('حذف کردن مقام', 'عملیات با موفقیت انجام شد');
        return redirect()->route('users.index');

    }
}
