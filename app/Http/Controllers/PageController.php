<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function AdminDashboard()
    {

        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $role = Auth::user()->role;

        return view('admin.adminDashboard',compact('name'));
    }
}
