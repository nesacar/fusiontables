<?php

namespace App\Providers;

use App\Menu;
use App\MenuLinkClear;
use App\Theme;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiseProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->composerMenu();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composerMenu(){
        $theme = Theme::getTheme();
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        view()->composer('themes.'.$theme.'.partials.nav', function($view) use ($topMenu){
            $view->with('topMenu', $topMenu);
        });
        view()->composer('themes.'.$theme.'.index', function($view) use ($topMenu){
            $view->with('topMenu', $topMenu);
        });
    }
}
