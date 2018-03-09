<?php

namespace App\Providers;

use App\Menu;
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
        $topMenu = Menu::find(1)->menuLinks()->where('publish', 1)->where('parent', 0)->orderBy('order', 'ASC')->get();
        view()->composer('themes.'.$theme.'.partials.nav', function($view) use ($topMenu){
            $view->with('topMenu', $topMenu);
        });
    }
}
