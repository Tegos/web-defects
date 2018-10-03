<?php

namespace App\Http\Controllers;

use \App\Image\ImageGrid;

class HomeController extends Controller
{

    public function index()
    {
        $data = [];
        $algorithms = ImageGrid::getAlgorithms();

        $data['algorithms'] = $algorithms;

        return view('home', $data);
    }

}
