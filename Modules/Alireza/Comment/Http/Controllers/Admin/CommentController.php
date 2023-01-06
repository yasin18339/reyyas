<?php

namespace Alireza\Comment\Http\Controllers\Admin;



use Alireza\Comment\Repositories\CommentRepo;
use App\Http\Controllers\Controller;


class CommentController extends Controller
{
    public CommentRepo $repo;

    public function __construct(CommentRepo $commentRepo)
    {
        $this->repo = $commentRepo;
    }

    public function index()
    {
        $comments = $this->repo->index()->paginate(10);
        return view('Comment::Admin.index', compact('comments'));
    }


    public function destroy($id)
    {
        $this->repo->delete($id);
        toast('حذف کامنت', 'success');
        return redirect()->route('comments.index');
    }

    public function active($id){
        $this->repo->changeStatus($id, Comment::STATUS_ACTIVE);
        alert()->success('فعال کردن وضعیت کامنت', 'عملیات با موفقیت انجام شد')->persistent('OK');
        return redirect()->route('comments.index');

    }
    public function inactive($id){
        $this->repo->changeStatus($id, Comment::STATUS_INACTIVE);
        alert()->success('غیر فعال کردن وضعیت کامنت', 'عملیات با موفقیت انجام شد')->autoClose(5000);
        return redirect()->route('comments.index');

    }
}
