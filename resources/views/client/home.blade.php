@extends('client.layout')
@section('title')
    HD Stock
@endsection

@section('content')
<main>
    <div class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded home-banner">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                    efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
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
                <a href="#" class="col-md-3 col-6 item">
                    <div class="post-item">
                        <img class="post-img" src="http://localhost/base-cms/base-cms/public/dist/img/photo1.png"
                            alt="">
                        <div class="post-title">Some text about me in culpa qui officia deserunt mollit anim</div>
                    </div>
                </a>
                <a href="#" class="col-md-3 col-6 item">
                    <div class="post-item">
                        <img class="post-img" src="http://localhost/base-cms/base-cms/public/dist/img/photo1.png"
                            alt="">
                        <div class="post-title">Some text about me in culpa qui officia deserunt mollit anim</div>
                    </div>
                </a>
                <a href="#" class="col-md-3 col-6 item">
                    <div class="post-item">
                        <img class="post-img" src="http://localhost/base-cms/base-cms/public/dist/img/photo1.png"
                            alt="">
                        <div class="post-title">Some text about me in culpa qui officia deserunt mollit anim</div>
                    </div>
                </a>
                <a href="#" class="col-md-3 col-6 item">
                    <div class="post-item">
                        <img class="post-img" src="http://localhost/base-cms/base-cms/public/dist/img/photo1.png"
                            alt="">
                        <div class="post-title">Some text about me in culpa qui officia deserunt mollit anim</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection