@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Quản Lý Thể Loại</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($genre))
                            {!! Form::open(['route' => 'genre.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['genre.update', $genre->id], 'method' => 'PUT']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($genre) ? $genre->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($genre) ? $genre->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($genre) ? $genre->description : '', [
                                'style' => 'resize: none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                                'id' => 'description',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Active', 'Active', []) !!}
                            {!! Form::select(
                                'status',
                                [
                                    '1' => 'Hiển Thị',
                                    '0' => 'Không Hiển Thị',
                                ],
                                isset($genre) ? $genre->status : null,
                                ['class' => 'form-control'],
                            ) !!}
                        </div>

                        @if (!isset($genre))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary pull-right']) !!}
                        @else
                            {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-primary pull-right']) !!}
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <table class="table" id="tablegenre">
                <thead>
                    <tr>
                        <th scope="col">Thứ Tự</th>
                        <th scope="col">Tiêu Đề</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Quản Lý</th>
                    </tr>
                </thead>
                <tbody class="order_position">
                    @foreach ($list as $key => $genres)
                        <tr class="{{ $genres->id }}">
                            <th scope="row">{{ $key }}</th>
                            <td>{{ $genres->title }}</td>
                            <td>{{ $genres->description }}</td>
                            <td>{{ $genres->slug }}</td>
                            <td>
                                @if ($genres->status)
                                    Hiển Thị
                                @else
                                    Không Hiển Thị
                                @endif
                            </td>
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['genre.destroy', $genres->id],
                                    'onSubmit' => 'return confirm("Bạn có muốn xóa hàng này không ?")',
                                    'class' => 'form-horizontal',
                                ]) !!}
                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <a href="{{ route('genre.edit', $genres->id) }}" class="btn btn-warning""> Sửa</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
