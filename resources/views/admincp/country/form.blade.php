@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Quản Lý Quốc Gia Phim</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($country))
                            {!! Form::open(['route' => 'country.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['country.update', $country->id], 'method' => 'PUT']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($country) ? $country->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($country) ? $country->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($country) ? $country->description : '', [
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
                                isset($country) ? $country->status : null,
                                ['class' => 'form-control'],
                            ) !!}
                        </div>

                        @if (!isset($country))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary pull-right']) !!}
                        @else
                            {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-primary pull-right']) !!}
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <table class="table" id="tablecountry">
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
                    @foreach ($list as $key => $countries)
                        <tr class="{{ $countries->id }}">
                            <th scope="row">{{ $key }}</th>
                            <td>{{ $countries->title }}</td>
                            <td>{{ $countries->description }}</td>
                            <td>{{ $countries->slug }}</td>
                            <td>
                                @if ($countries->status)
                                    Hiển Thị
                                @else
                                    Không Hiển Thị
                                @endif
                            </td>
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['country.destroy', $countries->id],
                                    'onSubmit' => 'return confirm("Bạn có muốn xóa hàng này không ?")',
                                    'class' => 'form-horizontal',
                                ]) !!}
                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <a href="{{ route('country.edit', $countries->id) }}" class="btn btn-warning"">
                                    Sửa</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
