<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\PanelAdmin;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $panels = [];
        
        foreach (config('panels') as $panel) {
            $panelAdmin = new PanelAdmin($panel);
            
            if($panelAdmin->nbr) {
                $panels[] = $panelAdmin;
            }
        }
        
        return view(env('THEME').'.back.index', compact('panels'));
    }
}
