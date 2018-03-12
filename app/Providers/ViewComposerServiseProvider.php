<?php

namespace App\Providers;

use App\Menu;
use App\MenuLink;
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
        $this->composerMenu();
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
        $topMenu = MenuLink::getNoParentLinksById(1);
        view()->composer('themes.'.$theme.'.partials.nav', function($view) use ($topMenu){
            $view->with('topMenu', $topMenu);
        });
    }
}
