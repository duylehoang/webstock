@extends('client.layout')
@section('title')
    {{ $category->name }}
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row main-content">
            @if($category->banner)
                <div class="featured-image">
                    <img src="{{asset('upload/categories/'. $category->banner)}}" alt="" class="img">
                </div>
            @endif
            <div class="col-md-9 post">
                <div class="category-header d-flex align-items-center p-3 my-3 text-white rounded shadow-sm">
                    <img class="me-3" src="{{asset('image/bootstrap-logo-white.svg')}}" alt="" width="48"
                        height="38">
                    <div class="lh-1">
                        <h1 class="h4 mb-0 text-white lh-1">{{$category->name}}</h1>
                    </div>
                </div>
                <div class="same-category">
                    <div class="row">
                        @if(count($posts) > 0)
                            @foreach($posts as $key=>$post)
                                <div class="col-md-4">
                                    <div class="thumbnail post-item">
                                        <a href="{{route('knowledge.article', $post->slug)}}">
                                            <img src="{{ load_img('upload/posts', $post->featured_image) }}" alt="{{$post->title}}" style="width:100%">
                                            <div class="caption">{{$post->title}}</div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                @include('client.components.fanpage')
            </div>
        </div>
    </div>
</main>
@endsection