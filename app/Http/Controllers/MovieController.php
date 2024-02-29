<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Category;
use App\Models\Genre;
use Carbon\Carbon;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $list = Movie::orderBy('id','DESC')->get();
        return view('admincp.movie.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        return view('admincp.movie.form', compact('category','genre','country'));
    }

    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->tags = $data['tags'];
        $movie->vietsub = $data['vietsub'];
        $movie->resolution = $data['resolution'];
        $movie->name_english = $data['name_english'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id =$data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        //thêm hình ảnh
        $get_image = $request->file('image'); // lấy hình ảnh từ input name="image"

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // nếu có ảnh được upload thì lấy cái tên gốc của ảnh hinhanh.jpg
            $name_image = current(explode('.',$get_name_image)); // lấy cái tên vừa get được tách ra dựa theo dấu . và lưu thành phần đã tách vào mảng với current-> [0] hinhanh . [1]jpg
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); // lấy tên hình ảnh + thêm random từ 0-99 -> hinhanh99, sau đó nối vào phần mở rộng -> hinhanh99.jpg
            $get_image->move('uploads/movie/',$new_image); // nó sẽ copy thêm 1 ảnh nữa vào đường dẫn path và tạo ra 1 ảnh mới
            $movie->image = $new_image;
        }
         $movie->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $category = Category::pluck('title', 'id');
    $genre = Genre::pluck('title', 'id');
    $country = Country::pluck('title', 'id');
    $list = Movie::with('showCategory','showGenre','showCountry')->orderBy('id', 'DESC')->get();
    $movie = Movie::find($id); // Lấy thông tin của phim cần chỉnh sửa thông qua id
    return view('admincp.movie.form', compact( 'category', 'genre', 'country', 'movie')); // Truyền biến qua view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->tags = $data['tags'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->vietsub = $data['vietsub'];
        $movie->resolution = $data['resolution'];
        $movie->name_english = $data['name_english'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id =$data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        //thêm hình ảnh\
        $get_image = $request->file('image'); // lấy hình ảnh từ input name="image"
        if($get_image){
              if(file_exists('uploads/movie/'.$movie->image)){
            unlink('uploads/movie/'.$movie->image);
            }

            $get_name_image = $get_image->getClientOriginalName(); // nếu có ảnh được upload thì lấy cái tên gốc của ảnh hinhanh.jpg
            $name_image = current(explode('.',$get_name_image)); // lấy cái tên vừa get được tách ra dựa theo dấu . và lưu thành phần đã tách vào mảng với current-> [0] hinhanh . [1]jpg
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension(); // lấy tên hình ảnh + thêm random từ 0-99 -> hinhanh99, sau đó nối vào phần mở rộng -> hinhanh99.jpg
            $get_image->move('uploads/movie/',$new_image); // nó sẽ copy thêm 1 ảnh nữa vào đường dẫn path và tạo ra 1 ảnh mới
            $movie->image = $new_image;
        }
         $movie->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $movie = Movie::find($id);

         if(file_exists('uploads/movie/'.$movie->image)){// Xóa ảnh từ thư mục uploads
            unlink('uploads/movie/'.$movie->image);
        }
        // Xóa phim từ cơ sở dữ liệu
        $movie->delete();

    return redirect()->back();
}

}
