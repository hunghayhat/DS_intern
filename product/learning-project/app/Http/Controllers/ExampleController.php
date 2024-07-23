<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage()
    {
        $ourName = 'Brad';
        $books = ['harry potter', 'Elsa'];
        
        return view('homepage', ['allBooks' => $books, 'name' => $ourName, 'catname' => 'Meowsalot']);
    }

    public function aboutPage() {
        return view ('single-post');
    }
}
