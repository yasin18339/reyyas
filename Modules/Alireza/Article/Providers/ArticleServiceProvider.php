<?php

namespace Alireza\Article\Providers;

use Alireza\Article\Models\Article;
use Alireza\Article\Policies\ArticlePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Article');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/');


        Route::middleware('web')->namespace('Alireza\Article\Http\Controllers')->group(__DIR__ . '/../Routes/article_routes.php');

        Gate::policy(Article::class, ArticlePolicy::class);

    }
    public function boot(){
        config()->set('panelConfig.menus.articles',[
            'url' => route('articles.index'),
            'title' => 'مقالات',
            'icon' => 'book',
        ]);

    }

}
