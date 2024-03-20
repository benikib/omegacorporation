<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Utilisateur;
use App\Models\Admin;
use App\Models\Reserver;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admins=count(Admin::all());
        $formations=count(Formation::all());
        $utilisateurs=count(Utilisateur::all());
        $reservation=count(Reserver::all());
        
        return view('home', compact('admins','utilisateurs','formations','reservation'));
    }
}
