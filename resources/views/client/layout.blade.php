<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- https://www.youtube.com/watch?v=tEC4kqzNTnM  --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- IziToast -->
    <link rel="stylesheet" href="{{ asset('plugins/iziToast/iziToast.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav>
        <label class="logo"><a href="{{route('home')}}">CodeX</a></label>
        <ul>
            <li><a href="{{url('/')}}" @if(isCurrentController('home')) class="active" @endif>Home</a></li>
            <li><a href="{{route('knowledge')}}" @if(isCurrentController('knowledge,knowledge.article')) class="active" @endif>Kiến thức co ban</a></li>
            <li><a href="{{route('sharing')}}" @if(isCurrentController('sharing,sharing.article')) class="active" @endif>Chia sẻ</a></li>
            <li><a href="{{route('contact') }}" @if(isCurrentController('contact')) class="active" @endif>Liên hệ</a></li>
        </ul>
        <label id="icon">
            <i class="fa-solid fa-bars"></i>
        </label>
    </nav>
    @yield('content')
    <footer>
        <div class="container">
            <div class="site-name">BaseCMS.com </div>
            <div class="slogan">Không chỉ là sự chia sẽ mà còn là những giá trị tốt đẹp nhất!</div>
        </div>
    </footer>

    <!--Hiển thị popup hình ảnh-->
    <div id="image-viewer">
        <span class="close">&times;</span>
        <img class="modal-content" id="full-image">
    </div>

    <!-- Jquery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- IziToast -->
    <script src="{{ asset('plugins/iziToast/iziToast.min.js') }}"></script>

    <script src="{{asset('js/client.js')}}"></script>
    
    <script>
        $(document).ready(function () {
            $('#icon').click(function () {
                $('ul').toggleClass('show');
            });

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
        });
    </script>
</body>

</html>