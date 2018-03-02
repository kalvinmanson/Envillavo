<?php

namespace App\Http\Controllers;
use App\Store;
use App\Record;
use Auth;

use Illuminate\Http\Request;

class StoreController extends Controller
{
  public function index(Request $request) {

    if($request->q) {
      $stores = Store::where('description', 'LIKE', '%'.$request->q.'%')->orderBy('views', 'desc')->limit(50)->get();
    } else {
      $stores = Store::inRandomOrder()->limit(12)->get();
    }
    return view('stores.index', compact('stores'));
  }
    public function show($slug)
    {
      $store = Store::where('slug', $slug)->first();
      $record = $this->getRecord($store->id);
      $store->views += 1;
      $store->save();

      return view('stores.show', compact('store', 'record'));
    }

    private function getRecord($store_id) {
      $records = session('records');
      if(!is_array($records)) {
        $records = [];
        session(['records' => []]);
      }
      return Record::whereIn('id', $records)->where('store_id', $store_id)->first();
    }
}
