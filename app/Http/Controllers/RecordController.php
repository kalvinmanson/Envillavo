<?php

namespace App\Http\Controllers;
use App\Store;
use App\Record;
use Auth;

use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function store(Request $request)
    {
      $this->validate(request(), [
          'name' => ['required', 'max:150'],
          'email' => ['required', 'max:150'],
          'store_id' => ['required']
      ]);
      $store = Store::find($request->store_id);


      $record = new Record;
      $record->store_id = $store->id;
      if($request->landing_id) {
        $record->landing_id = $request->landing_id;
      }
      $record->name = $request->name;
      $record->email = $request->email;
      $record->phone = $request->phone;
      $record->lat = $request->lat;
      $record->lng = $request->lng;
      $record->birthdate = $request->birthdate;
      $record->gender = $request->gender;
      $record->save();

      //store in session
      if ($request->session()->has('records')) {
        $request->session()->push('records', $record->id);
      } else {
        $request->session()->put('records', [$record->id]);
      }

      return redirect()->action('StoreController@show', $store->slug);
    }
}
