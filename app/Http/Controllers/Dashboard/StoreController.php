<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Store;
use Auth;
use Storage;
use File;
use Image;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index() {
    	$stores = Store::withTrashed()->get();
    	return view('dashboard.stores.index', compact('stores'));
    }
    public function store(Request $request) {
    	$this->validate(request(), [
            'name' => ['required', 'min:10', 'max:100']
        ]);

        $store = new Store;
        $store->name = $request->name;
        //Validar unico slug
        $slug = str_slug($request->name);
        $validate = Store::where('slug', $slug)->get();
        if(count($validate) > 0) {
            $slug = $slug . '-' . count($validate);
        }
        $store->slug = $slug;
        $store->save();
        flash('Tu nuevo comercio ha sido creado, ahora puedes agregar toda la información en el.')->success();
        return redirect()->action('Dashboard\StoreController@index');
    }

    public function edit($id) {
        $store = Store::withTrashed()->find($id);

        return view('dashboard.stores.edit', compact('store'));
    }

    public function update($id, Request $request) {

        $store = Store::withTrashed()->find($id);

        $this->validate(request(), [
            'name' => ['required', 'min:10', 'max:200'],
            'description' => ['required', 'min:50', 'max:250'],
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500',
        ]);
        //restore trashed item
        if($request->untrash) {
            $store->restore();
        }

        $store->name = $request->name;
        $store->city = $request->city;
        $store->address = $request->address;
        $store->lat = $request->lat;
        $store->lng = $request->lng;
        $store->phone = $request->phone;
        $store->mobile = $request->mobile;
        $store->schedule = $request->schedule;
        $store->facebook = $request->facebook;
        $store->twitter = $request->twitter;
        $store->tags = $request->tags;
        $store->description = $request->description;
        $store->content = $request->content;
        $store->metakeywords = $request->metakeywords;
        $store->metadescription = $request->metadescription;
        $store->colorset = $request->colorset;

        //upload logo
        if($request->hasFile('logo') && $request->file('logo')->isValid()) {
          $file = $request->file('logo');
          $img = Image::make($file)->fit(300)->encode();
          $name = $store->slug.'-logo.'.$file->getClientOriginalExtension();
          Storage::disk('public')->put($name, $img);
          $store->logo = '/storage/'.$name;
        }
        //upload cover
        if($request->hasFile('cover') && $request->file('cover')->isValid()) {
          $file = $request->file('cover');
          $img = Image::make($file)->fit(1200,600)->encode();
          $name = $store->slug.'-cover.'.$file->getClientOriginalExtension();
          Storage::disk('public')->put($name, $img);
          $store->cover = '/storage/'.$name;
        }

        $store->save();

        flash('Record updated')->success();
        return redirect()->action('Dashboard\StoreController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $store = Store::withTrashed()->find($id);
        if($store->trashed()) {
            $store->forceDelete();
        }
        Store::destroy($store->id);
        flash('Record deleted')->success();
        return redirect()->action('Dashboard\StoreController@index');
    }
}
