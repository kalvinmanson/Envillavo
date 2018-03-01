<?php

namespace App\Http\Controllers\Dashboard;

use App\Store;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
      return view('dashboard.users.index');
    }
}
