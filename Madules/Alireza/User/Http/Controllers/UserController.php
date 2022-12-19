<?php

namespace Alireza\User\Http\Controllers;

use Alireza\User\Http\UserRequest;
use Alireza\User\Http\UserUpdateRequest;
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

    public function index()
    {
        $users = $this->repo->index();
        return view('User::index', compact('users'));
    }


    public function create()
    {
        return view('User::create');
    }


    public function store(UserRequest $request)
    {
        $this->service->store($request);
        return redirect()->route('users.index');


    }

    public function edit($id)
    {
        $user = $this->repo->findById($id);
        return view('User::edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->service->update($request, $id);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('users.index')->with(['success_delete' => 'کابر با موفقیت حذف شد']);
    }
}
