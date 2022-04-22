@extends('layout')
@section('title')
    Setting 
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Cài đặt</h1>
        </div>
        <div class="card">
            <div class="card-header">
              <h2 class="h6">Cài đặt thông tin liên hệ</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('setting.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{array_key_exists('phone', $settings)? $settings['phone'] : null}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" 
                            value="{{array_key_exists('email', $settings)? $settings['email'] : null}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" 
                            value="{{array_key_exists('address', $settings)? $settings['address'] : null}}">
                    </div>
                    <div class="form-group">
                        <label for="contact_template">Contact template</label>
                        <select class="form-control" id="contact_template" name="contact_template">
                            <option value="">---- Lựa chọn template ----</option>
                            <option value="ssi" {{array_key_exists('contact_template', $settings) && $settings['contact_template']=='ssi'? 'selected' : null}}>SSI</option>
                            <option value="mbs" {{array_key_exists('contact_template', $settings) && $settings['contact_template']=='mbs'? 'selected' : null}}>MBS</option>
                            <option value="fts" {{array_key_exists('contact_template', $settings) && $settings['contact_template']=='fts'? 'selected' : null}}>FTS</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
              <h2 class="h6">Cài đặt banner trang chủ</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('setting.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="home_banner_title">Tiêu đề Banner</label>
                        <input type="text" class="form-control" id="home_banner_title" name="home_banner_title"
                            value="{{array_key_exists('home_banner_title', $settings)? $settings['home_banner_title'] : null}}">
                    </div>
                    <div class="form-group">
                        <label for="home_banner_description">Mô tả Banner</label>
                        <textarea name="home_banner_description" id="home_banner_description" class="form-control" 
                        rows="3">{{array_key_exists('home_banner_description', $settings)? $settings['home_banner_description'] : null}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="home_banner_link">Liên kết Link</label>
                        <input type="text" class="form-control" id="home_banner_link" name="home_banner_link" 
                            value="{{array_key_exists('home_banner_link', $settings)? $settings['home_banner_link'] : null}}">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h2 class="h6">Xóa Cache</h2>
            </div>
            <div class="card-body">
                <p>
                    <a href="{{route('setting.clear_cache')}}" class="mark">Clear Cache</a>
                </p>
                <p>
                    <a href="{{route('setting.clear_view')}}" class="mark">Clear View</a>
                </p>
                <p>
                    <a href="{{route('setting.clear_route')}}" class="mark">Clear Router</a>
                </p>
            </div>
        </div>
    </main>
@endsection