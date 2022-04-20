@extends('client.layout')
@section('title')
    Kien thuc trong abc tu
@endsection

@section('content')
<main>
    <div class="container">
        {{-- <div class="featured-image">
            <img src="./image/photo1.png" alt="" class="img">
        </div> --}}
        <div class="row">
            <div class="col-md-9 post">
                <div class="category-header d-flex align-items-center p-3 my-3 text-white rounded shadow-sm">
                    <img class="me-3" src="./image/bootstrap-logo-white.svg" alt="" width="48"
                        height="38">
                    <div class="lh-1">
                        <h1 class="h4 mb-0 text-white lh-1">Kien thuc trong abc tu</h1>
                    </div>
                </div>
                @foreach ($categories as $category)
                    @if($category->posts_count > 0)
                        <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <h2 class="border-bottom pb-2 mb-0">{{$category->name}}</h2>
                            @php 
                                $posts = $category->posts()->orderBy('sort_order')->get()
                            @endphp
                            @foreach($posts as $key=>$post)
                                @if($post->status)
                                <div class="d-flex pt-3">
                                    <div class="icon">{{$key + 1 }}</div>
                                    <p class="pb-2 mb-0 small">
                                        <a href="{{route('knowledge.article', $post->slug)}}" class="post-link">{{$post->title}}</a>
                                    </p>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
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