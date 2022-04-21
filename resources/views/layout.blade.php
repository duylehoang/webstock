<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    
    <!-- Font font-awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- IziToast -->
    <link rel="stylesheet" href="{{ asset('plugins/iziToast/iziToast.min.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{route('home')}}" target="_blank">Company name</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="{{route('logout')}}">Đăng xuất</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item @if(isCurrentController('dashboard')) active @endif">
                            <a class="nav-link"href="{{route('dashboard')}}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item @if(isCurrentController('category.index,category.create,category.edit')) active @endif">
                            <a class="nav-link" href="{{route('category.index')}}">
                                Categories
                            </a>
                        </li>
                        <li class="nav-item @if(isCurrentController('post.index,post.create,post.edit')) active @endif">
                            <a class="nav-link" href="{{route('post.index')}}">
                                Posts
                            </a>
                        </li>
                        <li class="nav-item @if(isCurrentController('profile')) active @endif">
                            <a class="nav-link" href="{{route('profile')}}">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item @if(isCurrentController('setting.index')) active @endif">
                            <a class="nav-link" href="{{route('setting.index')}}">
                                Setting
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc muốn xóa: <b id="data-delete"></b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- IziToast -->
    <script src="{{ asset('plugins/iziToast/iziToast.min.js') }}"></script>
    <!-- ckeditor -->
    <script src="{{ asset('plugins/ckeditor_full/ckeditor.js') }}"></script>

    <script src="{{asset('js/admin.js')}}"></script>

    <!-- Flash message -->
    <script type="text/javascript">
        @if (Session::has('status'))
            let status = "{{ Session::get('status') }}";
            let message = "{{ Session::get('message') }}";
            switch (status) {
                case "success":
                    iziToast.success({
                        title: "Thông báo",
                        message: message,
                        position: 'topRight'
                    });
                    break;
                case "warning":
                    iziToast.warning({
                        title: "cảnh báo",
                        message: message,
                        position: 'topRight'
                    });
                    break;
                case "error":
                    iziToast.error({
                        title: "Lỗi",
                        message: message,
                        position: 'topRight',
                    });
                    break;
                default:
                    break;
            }
        @endif
    </script>
</body>
</html>