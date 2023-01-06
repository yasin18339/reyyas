<?php

namespace Alireza\Home\Repositories;

use Alireza\Article\Models\Article;
use Alireza\Category\Models\Category;
use Alireza\Role\Models\Permission;
use Alireza\User\Models\User;

class HomeRepo
{
    public function vip_posts(){
        return Article::query()->where('status', Article::STATUS_ACTIVE)->whereType(Article::TYPE_VIP)->latest();
    }

    public function getActiveCategories(){
        return Category::query()->whereStatus(Article::STATUS_ACTIVE)->latest()->get();

    }
    public function getVipArticlesOrderByView(){

        return Article::query()->where('status', Article::STATUS_ACTIVE)->whereType(Article::TYPE_VIP)->orderByViews()->latest()->limit(5)->get();
    }
    public function getAuthorsUsers(){
        return User::query()->permission(Permission::PERMISSION_AUTHORS)->limit(20)->get();
    }
    public function getArticlesOrderByView(){

        return Article::query()->where('status', Article::STATUS_ACTIVE)->whereType(Article::TYPE_NORMAL)->orderByViews()->latest()->limit(3)->get();
    }

    public function getNewArticles(){
        return Article::query()->whereStatus(Article::STATUS_ACTIVE)->whereType(Article::TYPE_NORMAL)->latest()->limit(10)->get();
    }


}
