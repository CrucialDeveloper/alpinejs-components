<?php

namespace App\Http\Controllers;

use App\Component;
use Illuminate\Http\Request;
use Mexitek\PHPColors\Color;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'groups' => Component::with('creator')->orderBy('category')->orderBy('created_at')->get()->groupBy('category')
        ]);
    }
}
