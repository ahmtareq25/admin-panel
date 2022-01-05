<?php

namespace App\Http\Controllers;

use App\Traits\PermissionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    use PermissionTrait;

    public function index(Request $request){

        $this->getPermission(1);


        return view('admin.home');

    }
}
