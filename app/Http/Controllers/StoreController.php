<?php

namespace App\Http\Controllers;
use App\Store;
use Auth;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function show($slug)
    {
      $store = Store::where('slug', $slug)->first();
      return view('stores.show', compact('store'));
    }
}
