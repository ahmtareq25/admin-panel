<?php

namespace App\Http\Controllers;

use App\Traits\PermissionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    use PermissionTrait;

    public function index(Request $request){

        $testData = [
            'action' => 'test action'
        ];
        createLog($testData);

       flash('Transaction process successfully', 'success', 'Sale Transaction');
//       flash('You will be notified soon', 'info', 'Sale Transaction');

        $this->getPermission(1);


        return view('admin.home');

    }
}
