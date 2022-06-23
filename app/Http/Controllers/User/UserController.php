<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
        
    public function index(){
        return view('user.index');

    } 
 
}
