@extends('layout')
@section('title')
    Contact
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Danh sách người đăng ký</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="contact_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Nội dụng</th>
                        <th scope="col">Ngày đăng ký</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $key=>$item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->content}}</td>
                            <td>{{$item->created_at->format('d-m-Y H:i:s')}}</td>
                            <td>
                                <div class="text-center actions">
                                    <a href="{{route('contact.delete', $item->id)}}" data-delete="{{$item->name}}"
                                        class="icon-delete"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$contacts->links()}}
        </div>
    </main>
@endsection
