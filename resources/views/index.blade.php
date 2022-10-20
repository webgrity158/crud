@extends('welcome')
@section('title')
    Student List
@endsection
@section('main_template_area')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top:25px">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">{{session('message')}}</div>
                @endif
                <div class="panel  panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Student List</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.no.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($stdListing))
                                    @foreach ($stdListing as $key =>$stdVal)
                                        <tr>
                                            <td>{{$key+1}}.</td>
                                            <td>{{$stdVal->name}}</td>
                                            <td>{{$stdVal->email}}</td>
                                            <td>{{$stdVal->mobile}}</td>
                                            <td>
                                                <img src="{{ (!empty($stdVal->img))?asset($stdVal->img):asset('Image/No-Image.png') }}" alt="" class="img-circle" style="width: 85px;height: 80px;">
                                            </td>
                                            <td>
                                                <a href="{{ route('edit', $stdVal->id) }}" class="btn btn-danger btn-xs">
                                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('delete', $stdVal->id) }}" class="btn btn-warning btn-xs">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ route('addPageView') }}" class="btn btn-primary btn-sm" style="float: right;">Add Student</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection