<?php

namespace Alireza\Comment\Http\Controllers\Home;

use Alireza\Comment\Http\Requests\CommentRequest;
use Alireza\Comment\Services\CommentService;
use Alireza\Share\Repositories\ShareRepo;
use App\Http\Controllers\Controller;


class CommentController extends Controller
{
    public function store(CommentRequest $request,CommentService $commentService){
        $commentService->store($request);

        ShareRepo::successMassage('نظر شما با موفقیت ثبت شد');
        return back();

    }

}
