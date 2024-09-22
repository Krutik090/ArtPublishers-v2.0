<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;
class FrontendController extends Controller
{
    function index(){
        $hero = Hero::first();
        return view('frontend.home.index',compact('hero'));
    }
}
