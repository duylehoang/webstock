@extends('layout')
@section('title')
    Category 
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            @if($post->id)
                <h1 class="h3">Update Post</h1>
            @else
                <h1 class="h3">Create Post</h1>
            @endif
            
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{route('post.index')}}" class="btn btn-sm btn-outline-secondary">List</a>
            </div>
        </div>
        <form method="POST" action="{{$post->id? route('post.update', $post->id) : route('post.store')}}" enctype="multipart/form-data">
            @csrf
            @if($post->id) 
                @method('PUT')
            @endif
            @if(count($errors))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Dữ liệu không hợp lệ 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
                @if($errors->has('title'))
                    <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control convert-to-slug" id="slug" name="slug" value="{{old('slug', $post->slug)}}">
                @if($errors->has('slug'))
                    <small class="form-text text-danger">{{ $errors->first('slug') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image">
                @if($post->featured_image)
                    <img src="{{asset('upload/posts/'. $post->featured_image)}}" alt="" width="100px" class="mt-2">
                @endif
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">--- Select category ---</option>
                    @foreach($categories as $cate)
                        <option value="{{ $cate->id }}" {{ old('category_id', $post->category_id)==$cate->id ? 'selected' : null }}>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <small class="form-text text-danger">{{ $errors->first('category_id') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" rows="3" class="form-control">{{old('short_description', $post->short_description)}}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="4" class="form-control">{{old('content', $post->content)}}</textarea>
                <input type="hidden" id="post-upload-file" value="{{route('post.upload_file', ['_token' => csrf_token() ])}}">
                @if($errors->has('content'))
                    <small class="form-text text-danger">{{ $errors->first('content') }}</small>
                @endif
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ $post->status==1? 'checked': null }}>
                <label class="form-check-label" for="status">Publish post</label>
            </div>
            <div class="form-group">
                <label for="sort_order">Sort order</label>
                <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{old('sort_order', $post->sort_order)}}">
                @if($errors->has('sort_order'))
                    <small class="form-text text-danger">{{ $errors->first('sort_order') }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>
@endsection