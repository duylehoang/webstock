@extends('layout')
@section('title')
    Category 
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            @if($category->id)
                <h1 class="h3">Update Category</h1>
            @else
                <h1 class="h3">Create Category</h1>
            @endif
            
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{route('category.index')}}" class="btn btn-sm btn-outline-secondary">List</a>
            </div>
        </div>
        <form method="POST" action="{{$category->id? route('category.update', $category->id) : route('category.store')}}" enctype="multipart/form-data">
            @csrf
            @if($category->id) 
                @method('PUT')
            @endif
            @if(count($errors))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Dữ liệu không hợp lệ 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', $category->name)}}">
                @if($errors->has('name'))
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control convert-to-slug" id="slug" name="slug" value="{{old('slug', $category->slug)}}">
                @if($errors->has('slug'))
                    <small class="form-text text-danger">{{ $errors->first('slug') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="banner">Banner</label>
                <input type="file" class="form-control" id="banner" name="banner">
                @if($category->banner)
                    <img src="{{asset('upload/categories/'. $category->banner)}}" alt="" width="100px" class="mt-2">
                @endif
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" name="type" id="type">
                    <option value="">--- Select type ---</option>
                    <option value="1">Type 1</option>
                    <option value="2">Type 2</option>
                </select>
                @if($errors->has('type'))
                    <small class="form-text text-danger">{{ $errors->first('type') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control" name="parent" id="parent">
                    <option value="">--- Select parent ---</option>
                    @foreach($categories as $cate)
                        <option value="{{ $cate->id }}" {{ old('parent', $category->id)==$cate->id ? 'selected' : null }}>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('parent'))
                    <small class="form-text text-danger">{{ $errors->first('parent') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{old('description',$category->description)}}</textarea>
            </div>
            <div class="form-group">
                <label for="sort_order">Sort order</label>
                <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{old('sort_order', $category->sort_order)}}">
                @if($errors->has('sort_order'))
                    <small class="form-text text-danger">{{ $errors->first('sort_order') }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>
@endsection