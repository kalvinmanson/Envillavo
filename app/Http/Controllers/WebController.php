<?php

namespace App\Http\Controllers;
use App\Category;
use App\Page;
use App\Store;
use App\User;
use App\Block;
use Hash;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        return view('web.index');
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $pages = Page::where('category_id', $category->id)->paginate(12);
        if(view()->exists('web/cat-'.$slug)) {
            return view('web/cat-'.$slug, compact('category', 'pages'));
        } else {
            return view('web/cat', compact('category', 'pages'));
        }
    }
    public function page($category, $slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (view()->exists('web.page-cat-'.$category)) {
            return view('web/page-cat-'.$category, compact('page'));
        } else {
            return view('web/page', compact('page'));
        }
    }
    public function migrar() {
      $string = file_get_contents(public_path("tiendas.json"));
      $records = json_decode($string, true);

      foreach($records as $record) {
        //dd($record['dro_tiendas']);

        $validateUser = User::where('email', $record['dro_users']['email'])->first();
        if($validateUser) {
          $user = $validateUser;
        } else {
          $user = new User;
          $user->name = $record['dro_users']['nombre']." ";
          $user->username = $record['dro_users']['username'];
          $user->email = $record['dro_users']['email'];
          $user->password = $record['dro_users']['password'];
          $user->phone = $record['dro_users']['telefono'];
          $user->city = $record['dro_users']['ciudad'];
          $user->save();
        }

        //guardar store
        $store = new Store;
        $store->user_id = $user->id;
        $store->name = $record['dro_tiendas']['tienda'];
        $validate = Store::where('slug', $record['dro_tiendas']['slug'])->get();
        if($validate->count() > 0) { $slug = $record['dro_tiendas']['slug'].rand(200,900); } else { $slug = $record['dro_tiendas']['slug']; }
        $store->slug = $slug;
        $store->category = $record['dro_categories']['category'];
        $store->email = $user->email;
        $store->city = $user->city;
        $location = explode(",", $record['dro_tiendas']['location']);
        if(isset($location[0]) && isset($location[1])) {
          $store->lat = (float)trim($location[0]);
          $store->lng = (float)trim($location[1]);
        }
        else {
          $store->lat = 0;
          $store->lng = 0;
        }
        $store->phone = $user->phone;
        $store->mobile = $user->phone;
        $store->description = strip_tags($record['dro_tiendas']['description']);
        $metadescription = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u','', strip_tags($record['dro_tiendas']['description']));
        $store->metadescription = substr(strip_tags($metadescription),0,250);
        $store->content = $record['dro_tiendas']['description']."<hr>".$record['dro_tiendas']['contact_info'];
        if(!empty($record['dro_tiendas']['picture'])) { $store->logo = "/storage/".$record['dro_tiendas']['picture']; }
        if(!empty($record['dro_tiendas']['picture2'])) { $store->cover = "/storage/".$record['dro_tiendas']['picture2']; }
        $store->save();

        if(!empty($record['dro_tiendas']['picture'])) { $this->addPhoto("/storage/".$record['dro_tiendas']['picture'], $store->id, $store->name); }
        if(!empty($record['dro_tiendas']['picture2'])) { $this->addPhoto("/storage/".$record['dro_tiendas']['picture2'], $store->id, $store->name); }
        if(!empty($record['dro_tiendas']['picture3'])) { $this->addPhoto("/storage/".$record['dro_tiendas']['picture3'], $store->id, $store->name); }
        if(!empty($record['dro_tiendas']['picture4'])) { $this->addPhoto("/storage/".$record['dro_tiendas']['picture4'], $store->id, $store->name); }
        if(!empty($record['dro_tiendas']['picture5'])) { $this->addPhoto("/storage/".$record['dro_tiendas']['picture5'], $store->id, $store->name); }

        //add photos


      }

    }
    function addPhoto($photo='', $store_id, $name) {
      $block = new Block;
      $block->store_id = $store_id;
      $block->name = $name;
      $block->picture = $photo;
      $block->format = 'photo';
      $block->save();
      return true;
    }
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
