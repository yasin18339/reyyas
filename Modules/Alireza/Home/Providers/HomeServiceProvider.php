<?php

namespace Alireza\Home\Providers;

use Alireza\Category\Repositories\CategoryRepo;
use Alireza\Comment\Repositories\CommentRepo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Home');
//       $this->loadRoutesFrom(__DIR__ . '/../Routes/home_routes.php');

        Route::middleware('web')->namespace('Alireza\Home\Http\Controllers')->group(__DIR__ .'/../Routes/home_routes.php');
    }

    public function boot(){
        view()->composer(['Home::section.footer', 'Home::section.header'], static function($view){
            $categoryRepo = new CategoryRepo;
            $categories = $categoryRepo->getActiveCategories()->get();

            $view->with(['categories' => $categories]);
        });
        view()->composer(['Home::parts.sidebar_left'], static function($view){
            $commentRepo = new CommentRepo();
            $latestComments = $commentRepo->getLatestComments()->limit(4)->get();

            $view->with(['latestComments' => $latestComments]);
        });


        config()->set('panelConfig.menus.home',[
            'url' => route('home.index'),
            'title' => 'سایت اصلی',
            'icon' => 'home',
        ]);

    }
}
