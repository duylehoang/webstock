@extends('client.layout')
@section('title')
    {{ $category->name }}
@endsection

@section('content')
<main>
    <div class="container">
        @if($category->banner)
            <div class="featured-image">
                <img src="{{asset('upload/categories/'. $category->banner)}}" alt="" class="img">
            </div>
        @endif
        <div class="row">
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
                                <a href="{{route('client.article', $post->slug)}}" class="col-md-3 col-6 item">
                                    <div class="post-item">
                                        <img class="post-img" src="{{ load_img('upload/posts', $post->featured_image) }}"
                                            alt="{{$post->title}}">
                                        <div class="post-title">{{$post->title}}</div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ads-card">
                    <div class="ads-title">
                        Liên hệ khách hàng
                    </div>
                    <div class="ads-content">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum molestias incidunt
                        consequatur aut eaque sed
                    </div>
                </div>
                <div class="ads-card">
                    <div class="ads-title">
                        Liên hệ khách hàng
                    </div>
                    <div class="ads-content">
                        oluptates excepturi! Illo, ipsa a necessitatibus cum veniam, laudantium deleniti maxime at
                        dolore unde mollitia?
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection