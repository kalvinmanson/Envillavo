<?php

namespace App\Http\Controllers;
use App\Store;
use Auth;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show($slug)
    {
        return view('stores.show');
    }
}
