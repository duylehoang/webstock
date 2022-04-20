@extends('client.layout')
@section('title')
    {{$post->title}}
@endsection

@section('content')
<main>
    <div class="container">
        @if($post->featured_image)
            <div class="featured-image">
                <img src="{{asset('upload/posts/'. $post->featured_image)}}" alt="" class="img">
            </div>
        @endif
        <div class="row">
            <div class="col-md-9 post">
                <div class="post-header">
                    <div class="category-name">
                        <a href="{{route('client.category', $post->category->slug)}}">#{{$post->category->name}}</a>
                    </div>
                    <h1 class="title">{{$post->title}}</h1>
                    <div class="center-divider"></div>
                    <div class="author">posted of <span>{{$post->created_at->format('d-m-Y')}}</span> by <span>Admin</span></div>
                </div>
                <div class="post-content animation-page">
                    {!! $post->content !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="ads-card">
                    <div class="ads-title"> 
                        Liên hệ khách hàng
                    </div>
                    <div class="ads-content">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum molestias incidunt consequatur aut eaque sed
                    </div>
                </div>
                <div class="ads-card">
                    <div class="ads-title"> 
                        Liên hệ khách hàng
                    </div>
                    <div class="ads-content">
                        oluptates excepturi! Illo, ipsa a necessitatibus cum veniam, laudantium deleniti maxime at dolore unde mollitia?
                    </div>
                </div>
            </div>
        </div>
        @if(count($otherPosts) > 0)
            <div class="same-category">
                <div class="title">Bài viết cùng chuyên mục</div>
                <div class="row">
                    @foreach ($otherPosts as $item)
                        <a href="{{ route('client.article', $item->slug) }}" class="col-md-3 col-6 item">
                            <div class="post-item">
                                <img class="post-img" src="{{ load_img('upload/posts', $item->featured_image) }}" alt="{{ $item->title }}">
                                <div class="post-title">{{$item->title}}</div>
                            </div>
                        </a>                    
                    @endforeach
                </div>
            </div>
        @endif 
    </div>
</main>
@endsection