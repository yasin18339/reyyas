<?php

namespace Alireza\User\Http\Controllers\Home;


use Alireza\Article\Repositories\ArticleRepo;
use Alireza\Role\Models\Permission;
use Alireza\Share\Repositories\ShareRepo;
use Alireza\Share\Services\ShareService;
use Alireza\User\Http\Requests\UpdateProfileRequest;
use Alireza\User\Repositories\Home\UserRepo;
use Alireza\User\Services\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public UserRepo $repo;


    public function __construct(UserRepo $userRepo)
    {
        $this->repo = $userRepo;

    }
    public function authors(){
        $authors = $this->repo->authors()->paginate(50);
        return view('User::Home.authors', compact('authors'));
    }
    public function author($name, ArticleRepo $articleRepo){
        $author = $this->repo->findByName($name)->permission(Permission::PERMISSION_AUTHORS)->first();
        if (is_null($author)) abort(404);
        $articles = $articleRepo->getArticlesByUserId($author->id)->paginate(10);
        return view('User::Home.author', compact(['author', 'articles']));
    }
    public function profile(){
        return view('User::Home.profile');

    }

    public function updateProfile(UpdateProfileRequest $request, UserService $userService){
        if ($request->image){
            [$imageName, $imagePath] = ShareService::uploadImage($request->file('image'), 'users');
        }else{
            $imageName = auth()->user()->imageName;
            $imagePath = auth()->user()->imagePath;
        }


        $userService->updateProfile($request, auth()->id(), $imageName, $imagePath);

        ShareRepo::successMassage('بروزرسانی پروفایل کاربری');
        return back();

    }
}
