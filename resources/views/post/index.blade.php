@extends('layout')
@section('title')
    Category
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Danh sách bài viết</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('post.create') }}" class="btn btn-sm btn-outline-secondary">Add</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="post_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Category</th>
                        <th scope="col">Featured Image</th>
                        <th scope="col">Sort Order</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key=>$item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->slug}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>@if($item->featured_image)
                                <img src="{{asset('upload/posts/'.$item->featured_image)}}" alt="" width="40px">
                            @endif</td>
                            <td>{{$item->sort_order}}</td>
                            <td>
                                <div class="text-center actions">
                                    <a href="{{route('post.edit', $item->id)}}"
                                        class="icon-edit"><i class="far fa-edit"></i></a>
                                    <a href="{{route('post.delete', $item->id)}}" data-delete="{{$item->title}}"
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
