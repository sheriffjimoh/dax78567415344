<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\mail\UserCredencials;
use Auth;
use App\Site;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {  
        $user_id = Auth::user()->id;
        $this->middleware('auth');
       $this->site = new Site($user_id);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ($this->site->Loggedin()) {
            if ($this->site->Isadmin()) {
               return redirect('/admin');
            }else{
                return redirect('/guess');
            }
        }else{
              return redirect('/login');
        }
    }







   }
