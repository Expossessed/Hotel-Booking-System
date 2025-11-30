<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Rooms::take(3)->get();
        return view('home', compact('rooms'));
    }
}
