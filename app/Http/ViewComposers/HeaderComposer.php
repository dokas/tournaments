<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class HeaderComposer
{
    
    public function compose(View $view)
    {
        // Breadcrumb
        $elements = config ('breadcrumbs');
        $segments = request()->segments();

        foreach ($segments as $segment) {
            if (!is_numeric($segment)) {
                $elements[$segment]['name'] = __('admin.breadcrumbs.' . $elements[$segment]['name'] . '-name');
                if($segment === end($segments)) {
                    $elements[$segment]['url'] = '#';
                }
                $breadcrumbs[] = $elements[$segment];
            }
        }
        
        // Title
        $title = config('titles.' . Route::currentRouteName());
        $title = __('admin.titles.' . $title);
        
        $view->with(compact('breadcrumbs', 'title'));
    }
    
}
