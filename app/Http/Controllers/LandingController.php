<?php

namespace App\Http\Controllers;
use App\Store;
use App\Record;
use App\Landing;
use Auth;
use Storage;
use File;
use Image;

use Illuminate\Http\Request;

class LandingController extends Controller
{
  public function index($slug, Request $request) {

    $store = Store::where('slug', $slug)->first();

    return view('landings.index', compact('store'));
  }
  public function store($slug, Request $request) {

    $this->validate(request(), [
        'name' => ['required', 'min:10', 'max:100']
    ]);

    $store = Store::where('slug', $slug)->where('user_id', Auth::user()->id)->first();
    if(!$store) {
      flash('No tienes acceso a este contenido.')->error();
      return redirect('/');
    }

    $landing = new Landing;
    $landing->store_id = $store->id;
    //Validar unico slug
    $landingSlug = str_slug($request->name);
    $validate = Landing::where('slug', $landingSlug)->get();
    if(count($validate) > 0) {
        $landingSlug = $landingSlug . '-' . count($validate);
    }
    $landing->slug = $landingSlug;
    $landing->name = $request->name;
    $landing->save();

    flash('El nuevo landing de tu producto/servicio ha sido creado.')->success();
    return redirect()->action('LandingController@index', $store->slug);
  }
  public function show($store, $slug)
  {
    $store = Store::where('slug', $store)->first();
    $landing = Landing::where('slug', $slug)->where('store_id', $store->id)->first();
    $record = $this->getRecord($store->id);
    $landing->views += 1;
    $landing->save();

    return view('landings.show', compact('landing', 'record'));
  }

  public function edit($slug, $id) {
    $store = Store::where('slug', $slug)->where('user_id', Auth::user()->id)->first();
    if(!$store) {
      flash('No tienes acceso a este contenido.')->error();
      return redirect('/');
    }
    $landing = Landing::where('id', $id)->where('store_id', $store->id)->first();
    return view('landings.edit', compact('landing'));
  }

  public function update($slug, $id, Request $request) {
    $store = Store::where('slug', $slug)->where('user_id', Auth::user()->id)->first();
    if(!$store) {
      flash('No tienes acceso a este contenido.')->error();
      return redirect('/');
    }

    $landing = Landing::where('id', $id)->where('store_id', $store->id)->first();

    $this->validate(request(), [
        'name' => ['required', 'min:10', 'max:200'],
        'description' => ['required', 'min:50', 'max:250'],
        'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500',
        'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500',
    ]);

    $landing->name = $request->name;
    $landing->description = $request->description;
    $landing->content = $request->content;
    $landing->metakeywords = $request->metakeywords;
    $landing->metadescription = $request->metadescription;

    //upload picture
    if($request->hasFile('picture') && $request->file('picture')->isValid()) {
      $file = $request->file('picture');
      $img = Image::make($file)->fit(300)->encode();
      $name = $landing->slug.'-picture.'.$file->getClientOriginalExtension();
      Storage::disk('public')->put($name, $img);
      $landing->picture = '/storage/'.$name;
    }
    //upload cover
    if($request->hasFile('cover') && $request->file('cover')->isValid()) {
      $file = $request->file('cover');
      $img = Image::make($file)->fit(1200,600)->encode();
      $name = $landing->slug.'-cover.'.$file->getClientOriginalExtension();
      Storage::disk('public')->put($name, $img);
      $landing->cover = '/storage/'.$name;
    }

    $landing->save();

    flash('Tus cambios han sido guardados.')->success();
    return redirect()->action('LandingController@index', $landing->store->slug);
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

  private function getRecord($store_id) {
    $records = session('records');
    if(!is_array($records)) {
      $records = [];
      session(['records' => []]);
    }
    return Record::whereIn('id', $records)->where('store_id', $store_id)->first();
  }
}
