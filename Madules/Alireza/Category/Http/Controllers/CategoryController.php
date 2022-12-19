<?php

namespace Alireza\Category\Http\Controllers;

use Alireza\Category\Models\Category;
use Alireza\Category\Repositories\CategoryRepo;
use Alireza\Category\Services\CategoryService;
use App\Http\Controllers\Controller;
use Alireza\Category\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public CategoryRepo $repo;
    public CategoryService $service;
    public function __construct(CategoryRepo  $categoryRepo, CategoryService $categoryService)
    {
        $this->repo = $categoryRepo;
        $this->service = $categoryService;
    }

    public function index()
    {
        $categories = $this->repo->index()->paginate(10);
        return view('Category::index', compact('categories'));
    }


    public function create()
    {
        $categories = $this->repo->index()->get();
        return view('Category::create', compact('categories'));
    }


    public function store(CategoryRequest $request)
    {
        $this->service->store($request);
        return redirect()->route('categories.index');

    }


    public function edit($id)
    {
        $category = $this->repo->findById($id);
        return view('Category::edit', compact('category'));
    }


    public function update(CategoryRequest $request, $id)
    {
        $this->service->update($request, $id);
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('categories.index');
    }
}
