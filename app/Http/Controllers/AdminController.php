<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Carpeta;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $total_usuarios = User::count();
        $total_carpetas=Carpeta::count();
        return view('admin.index',compact('total_usuarios','total_carpetas'));

    }
}
