@extends('layout')
@section('title')
    Category
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Các danh mục bài viết</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('category.create') }}" class="btn btn-sm btn-outline-secondary">Add</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="category_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Thuộc Menu</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Banner</th>
                        <th scope="col">Sort Order</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key=>$item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->slug}}</td>
                            <td>{!! category_type($item->type) !!}</td>
                            <td>{{$item->parentCategory? $item->parentCategory->name: null}}</td>
                            <td>@if($item->banner)
                                <img src="{{asset('upload/categories/'.$item->banner)}}" alt="" width="40px">
                                @endif
                            </td>
                            <td>{{$item->sort_order}}</td>
                            <td>
                                <div class="text-center actions">
                                    <a href="{{route('category.edit', $item->id)}}"
                                        class="icon-edit"><i class="far fa-edit"></i></a>
                                    <a href="{{route('category.delete', $item->id)}}" data-delete="{{$item->name}}"
                                        class="icon-delete"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
