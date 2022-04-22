@extends('client.layout')
@section('title')
    HD Stock
@endsection

@section('content')
<main>
    <div class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded home-banner">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">{{array_key_exists('home_banner_title', $settings)? $settings['home_banner_title'] : null}}</h1>
                <p class="lead my-3">{{array_key_exists('home_banner_description', $settings)? $settings['home_banner_description'] : null}}</p>
                <p class="lead mb-0"><a href="{{array_key_exists('home_banner_link', $settings)? $settings['home_banner_link'] : null}}" class="text-white fw-bold">Xem thêm...</a></p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col-md-8 col-12 p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">World</strong>
                        <h3 class="mb-0">Featured post</h3>
                        <div class="mb-1 text-muted">Nov 12</div>
                        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural
                            lead-in to additional content.</p>
                        <a href="#" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-md-4">
                        <img src="image/400x400.jpg" width="100%" height="100%">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col-md-8 col-12 p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">World</strong>
                        <h3 class="mb-0">Featured post</h3>
                        <div class="mb-1 text-muted">Nov 12</div>
                        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural
                            lead-in to additional content.</p>
                        <a href="#" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-md-4">
                        <img src="image/400x400.jpg" width="100%" height="100%">
                    </div>
                </div>
            </div>
        </div>
        <div class="same-category">
            <div class="title">Bài viết mới nhất</div>
            <div class="row">
                @foreach ($latest_post as $post)
                    <div class="col-md-3">
                        <div class="thumbnail post-item">
                            @if($post->category->type == 1) 
                                <a href="{{route('knowledge.article', $post->slug)}}">
                                    <img src="{{ load_img('upload/posts', $post->featured_image) }}" alt="Fjords" style="width:100%">
                                    <div class="caption">{{$post->title}}</div>
                                </a>
                            @elseif($post->category->type == 2)
                                <a href="{{route('sharing.article', $post->slug)}}">
                                    <img src="{{ load_img('upload/posts', $post->featured_image) }}" alt="Fjords" style="width:100%">
                                    <div class="caption">{{$post->title}}</div>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection