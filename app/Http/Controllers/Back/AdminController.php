<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\PannelAdmin;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pannels = [];
        
        foreach (config('pannels') as $pannel) {
            $pannelAdmin = new PannelAdmin($pannel);
            
            if($pannelAdmin->nbr) {
                $pannels[] = $pannelAdmin;
            }
        }
        
        return view(env('THEME').'.back.index', compact('pannels'));
    }
}
