@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Quản Lý Phim</div>
                    <div class="card-body">
                        <a href="{{ route('movie.index') }}" class="btn btn-primary">Danh Sách Phim</a>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($movie))
                            {!! Form::open(['route' => 'movie.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['route' => ['movie.update', $movie->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('name_english', 'Name English', []) !!}
                            {!! Form::text('name_english', isset($movie) ? $movie->name_english : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', [
                                'style' => 'resize: none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                                'id' => 'description',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('tags', 'Tags Phim', []) !!}
                            {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', [
                                'style' => 'resize: none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Trạng Thái', []) !!}
                            {!! Form::select(
                                'status',
                                [
                                    '1' => 'Hiển Thị',
                                    '0' => 'Không Hiển Thị',
                                ],
                                isset($movie) ? $movie->status : null,
                                ['class' => 'form-control'],
                            ) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('resolution', 'Định Dạng', []) !!}
                            {!! Form::select(
                                'resolution',
                                [
                                    '0' => 'HD',
                                    '1' => 'HD+',
                                    '2' => 'FHD',
                                ],
                                isset($movie) ? $movie->resolution : null,
                                ['class' => 'form-control'],
                            ) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('vietsub', 'Vietsub', []) !!}
                            {!! Form::select(
                                'vietsub',
                                [
                                    '0' => 'Vietsub',
                                    '1' => 'Thuyết minh',
                                ],
                                isset($movie) ? $movie->vietsub : null,
                                ['class' => 'form-control'],
                            ) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('thoiluong', 'Thời lượng', []) !!}
                            {!! Form::text('thoiluong', isset($movie) ? $movie->thoiluong : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Category', 'Category', []) !!}
                            {!! Form::select('category_id', $category, isset($movie) ? $movie->category : null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Country', 'Country', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country : null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Genre', 'Genre', []) !!}
                            {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre : null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('PhimHot', 'PhimHot', []) !!}
                            {!! Form::select(
                                'phim_hot',
                                [
                                    '1' => 'Có',
                                    '0' => 'Không',
                                ],
                                isset($movie) ? $movie->phim_hot : null,
                                ['class' => 'form-control'],
                            ) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Image', 'Imgae', []) !!}
                            {!! Form::file('image', ['class' => 'form-control-file']) !!}
                            @if (isset($movie))
                                <img width="20%" src=" {{ asset('uploads/movie/' . $movie->image) }}">
                            @endif
                        </div>

                        @if (!isset($movie))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary pull-right']) !!}
                        @else
                            {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-primary pull-right']) !!}
                        @endif


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
