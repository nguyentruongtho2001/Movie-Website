@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
            <table class="table" id="tablePhim">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tiêu Đề</th>
                        <th scope="col">English</th>
                        <th scope="col">Image</th>
                        <th scope="col">Thời Lượng</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Phim Hot</th>
                        <th scope="col">Định Dạng</th>
                        <th scope="col">Vietsub</th>
                        {{-- <th scope="col">Mô Tả</th> --}}
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Danh Mục</th>
                        <th scope="col">Thể Loại</th>
                        <th scope="col">Quốc Gia</th>
                        <th scope="col">Ngày Tạo</th>
                        <th scope="col">Ngày Cập Nhật</th>
                        <th scope="col">Năm Phát Hành</th>
                        <th scope="col">Quản Lý</th>
                    </tr>
                </thead>
                <tbody class="order_position">
                    @foreach ($list as $key => $movies)
                        <tr class="{{ $movies->id }}">
                            <th scope="row">{{ $key }}</th>
                            <td>{{ $movies->title }}</td>
                            <td>{{ $movies->name_english }}</td>
                            <td><img width="20%" src=" {{ asset('uploads/movie/' . $movies->image) }}"></td>
                            <td>{{ $movies->thoiluong }}</td>
                            <td>{{ $movies->slug }}</td>
                            <td>{{ $movies->tags }}</td>
                            <td>
                                @if ($movies->phim_hot == 0)
                                    Không
                                @else
                                    Có
                                @endif
                            </td>
                            <td>
                                @if ($movies->resolution == 0)
                                    HD
                                @elseif($movies->resolution == 1)
                                    HD+
                                @else
                                    FHD
                                @endif
                            </td>
                            <td>
                                @if ($movies->vietsub == 0)
                                    Vietsub
                                @else
                                    Thuyết minh
                                @endif
                            </td>
                            {{-- <td>{{ $movies->description }}</td> --}}
                            <td>
                                @if ($movies->status)
                                    Hiển Thị
                                @else
                                    Không Hiển Thị
                                @endif
                            </td>
                            <td>{{ $movies->showCategory->title }}</td>
                            <td>{{ $movies->showGenre->title }}</td>
                            <td>{{ $movies->showCountry->title }}</td>
                            <td>{{ $movies->ngaytao }}</td>
                            <td>{{ $movies->ngaycapnhat }}</td>
                            <td>
                                {!! Form::selectYear('year', 2000, 2024, isset($movies->year) ? $movies->year : '', [
                                    'class' => 'select-year',
                                    'id' => $movies->id,
                                ]) !!}
                            </td>

                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['movie.destroy', $movies->id],
                                    'onSubmit' => 'return confirm("Bạn có muốn xóa hàng này không ?")',
                                    'class' => 'form-horizontal',
                                ]) !!}
                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <a href="{{ route('movie.edit', $movies->id) }}" class="btn btn-warning""> Sửa</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
