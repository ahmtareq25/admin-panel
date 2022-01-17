<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{

    public function index(Request $request){

        $data = [
            'page_title' => 'Dashboard'
        ];

        return view('admin.home', $data);

    }
}
