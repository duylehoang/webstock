@extends('client.layout')
@section('title')
    {{$post->title}}
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row main-content">
            <div class="col-md-9 post">
                @if($post->featured_image)
                    <div class="featured-image">
                        <img src="{{asset('upload/posts/'. $post->featured_image)}}" alt="" class="img">
                    </div>
                @endif
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
                @include('client.components.fanpage')
                @include('client.components.contact_form')
            </div>
        </div>
        @if(count($otherPosts) > 0)
            <div class="same-category">
                <div class="title">Bài viết cùng chuyên mục</div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            @if(count($otherPosts) > 0)
                                @foreach($otherPosts as $item)
                                    <div class="col-md-4">
                                        <div class="thumbnail post-item">
                                            <a href="{{ route('knowledge.article', $item->slug) }}">
                                                <img src="{{ load_img('upload/posts', $item->featured_image) }}" alt="{{ $item->title }}" style="width:100%">
                                                <div class="caption">{{$item->title}}</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif 
    </div>
</main>
@endsection