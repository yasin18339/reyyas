<?php

namespace Alireza\Article\Http\Controllers\Admin;

use Alireza\Article\Http\Requests\ArticleRequest;
use Alireza\Article\Models\Article;
use Alireza\Article\Repositories\ArticleRepo;
use Alireza\Article\Services\ArticleService;
use Alireza\Category\Repositories\CategoryRepo;
use Alireza\Share\Repositories\ShareRepo;
use Alireza\Share\Services\ShareService;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    private string $class = Article::class;

    public ArticleRepo $repo;
    public ArticleService $service;

    public function __construct(ArticleRepo $articleRepo, ArticleService $articleService)
    {
        $this->repo = $articleRepo;
        $this->service = $articleService;
    }

    public function index()
    {
        $this->authorize('manage', $this->class);
        $articles = $this->repo->index()->paginate(10);

        return view('Article::Admin.index', compact('articles'));
    }


    public function create(CategoryRepo $categoryRepo)
    {
        $this->authorize('manage', $this->class);
        $categories = $categoryRepo->getActiveCategories()->get();
        return view('Article::Admin.create', compact('categories'));
    }

    public function store(ArticleRequest $request)
    {
        $this->authorize('manage', $this->class);

        [$imageName, $imagePath] = ShareService::uploadImage($request->file('image'), 'articles');

        $this->service->store($request, auth()->id(), $imageName,  $imagePath);

       ShareRepo::successMassage('ساخت مقاله');
        return redirect()->route('articles.index');
    }

    public function edit($id, CategoryRepo $categoryRepo)
    {
        $this->authorize('manage', $this->class);
        $article = $this->repo->findById($id);
        $categories = $categoryRepo->getActiveCategories()->get();
        return view('Article::Admin.edit', compact(['article', 'categories']));
    }

    public function update(ArticleRequest $request, $id)
    {
        $this->authorize('manage', $this->class);
        $file = $request->file('image');
        $article = $this->repo->findById($id);

        [$imageName, $imagePath] = $this->uploadImage($file, $article);


        $this->service->update($request, $id, $imageName,  $imagePath);

        ShareRepo::successMassage('ویرایش مقاله');
        return redirect()->route('articles.index');
    }


    public function destroy($id)
    {
        $this->authorize('manage', $this->class);
        $article = $this->repo->findById($id);
        $this->service->deleteImage($article);
        $this->repo->delete($id);

        ShareRepo::successMassage('حذف مقاله');
        return redirect()->route('articles.index');

    }

   public function changeStatus ($id){
       $article = $this->repo->findById($id);
       $this->service->changeStatus($article);


       ShareRepo::successMassage('تغییر وضعیت مقاله');
       return redirect()->route('articles.index');

   }


    public function uploadImage($file, $article): array
    {
        if (! is_null($file)) {
            [$imageName, $imagePath] = $this->service->uploadImage($file);
        } else {
            $imageName = $article->imageName;
            $imagePath = $article->imagePath;
        }
        return array($imageName, $imagePath);
    }
}
