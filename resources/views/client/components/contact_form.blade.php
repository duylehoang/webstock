<div class="ads-card">
    <div class="ads-title">
        Đăng ký nhận bài viết mới
    </div>
    <div class="ads-content">
        <form method="POST" action="{{route('subscribe')}}">
            @csrf 
            <div class="form-group">
                <label for="name">Tên của bạn</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                @if($errors->has('name'))
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="title">Địa chỉ Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                @if($errors->has('email'))
                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-sm btn-success">Gửi</button>
            </div>
        </form>
    </div>
</div>