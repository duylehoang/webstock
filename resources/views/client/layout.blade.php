<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>
    <!-- https://www.youtube.com/watch?v=tEC4kqzNTnM -->
</head>

<body>
    <nav>
        <label class="logo">CodeX</label>
        <ul>
            <li><a href="{{url('/')}}" class="active">Home</a></li>
            <li><a href="{{route('knowledge')}}">Kiến thức trong abc tu</a></li>
            <li><a href="{{route('sharing')}}">Chia sẻ</a></li>
            <li><a href="{{route('contact') }}">Liên hệ</a></li>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('js/client.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#icon').click(function () {
                $('ul').toggleClass('show');
            })
        })
    </script>
</body>

</html>