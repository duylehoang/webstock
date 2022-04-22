@extends('client.layout')
@section('title')
    Liên hệ
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row main-content" id="contact_page">
                <div style="text-align:center">
                    <h1 class="h2">Liên hệ</h1>
                    <p>Bạn có thể liên hệ với tôi bằng cách điền thông tin vào Form <br> Hoặc liên hệ qua các thông tin sau:</p>
                </div>
                <div class="row">
                    <div class="column">
                        <img src="{{asset('image/photo1.png')}}" style="width:100%">
                    </div>
                    <div class="column">
                        <form method="POST" action="{{route('subscribe')}}">
                            @csrf
                            <label for="name">Ho tên</label>
                            <input type="text" id="name" name="name" placeholder="Nhập tên ...">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Nhập Email ...">
                            <label for="content">Nội dung</label>
                            <textarea id="content" name="content" placeholder="Hãy nhập nội dung vào đây ..." style="height:150px"></textarea>
                            <input type="submit" value="Gửi đi">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
