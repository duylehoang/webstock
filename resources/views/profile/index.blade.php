@extends('layout')
@section('title')
    Profile 
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">My Profile</h1>
        </div>
        <form method="POST" action="{{route('profile.post')}}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name)}}">
                @if($errors->has('name'))
                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email', $user->email)}}">
                @if($errors->has('email'))
                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="change_pass" name="change_pass" value="1">
                <label class="form-check-label" for="change_pass">Change Password</label>
            </div>
            <div class="form-group">
                <label for="password">New password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" disabled>
                @if($errors->has('password'))
                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="password_confirm">Password confirm</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="{{old('password_confirm')}}" disabled>
                @if($errors->has('password_confirm'))
                    <small class="form-text text-danger">{{ $errors->first('password_confirm') }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>
@endsection