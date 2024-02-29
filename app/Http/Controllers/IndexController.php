<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Episode;
use DB;
class IndexController extends Controller
{
    public function home(){
        $phimhot = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat', 'DESC')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $category_home = Category::with('movie')->orderBy('id','DESC')->where('status',1)->get();

        return view('pages.home', compact('category','genre', 'country','category_home','phimhot'));
    }

       public function category($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cate_slug->id)->orderBy('ngaycapnhat', 'DESC')->paginate(8);

        return view('pages.category',compact('category','genre', 'country','cate_slug','movie'));
    }

       public function genre($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $genre_slug = Genre::where('slug',$slug)->first();
        $movie = Movie::where('genre_id',$genre_slug->id)->orderBy('ngaycapnhat', 'DESC')->paginate(8);

        return view('pages.genre',compact('category','genre', 'country','genre_slug','movie'));
    }

        public function country($slug){
        $category = Category::orderBy('id','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $countr_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$countr_slug->id)->orderBy('ngaycapnhat', 'DESC')->paginate(8);

        return view('pages.country',compact('category','genre', 'country','countr_slug','movie'));
    }

        public function movie($slug){
        $category = Category::orderBy('id','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $movie = Movie::with('showCategory','showCountry','showGenre')->where('slug',$slug)->where('status',1)->first();
        $resolution = Movie::with('showCategory','showCountry','showGenre')->where('category_id',$movie->showCategory->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get(); // whereNotIN trừ cái film hiện tại
        return view('pages.movie',compact('category','genre', 'country','movie','resolution'));
}

        public function year($year){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $year = $year;
        $movie = Movie::where('year',$year)->orderBy('ngaycapnhat', 'DESC')->paginate(8);

        return view('pages.year',compact('category','genre', 'country','year','movie'));
    }

        public function tags($tag){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $tag = $tag;
        $movie = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('ngaycapnhat', 'DESC')->paginate(8);

        return view('pages.tags',compact('category','genre', 'country','tag','movie'));
        }

       public function watch(){
        return view('pages.watch');
    }

    public function episode(){
        return view('pages.episode');
    }
}
