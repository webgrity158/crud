@extends('welcome')
@section('title')
Add Student Daetails
@endsection
@section('main_template_area')
<div class="container">
    <div class="row">
        <div class="col-md-8" style="margin-top: 25px">
            @if ($errors->all())
              <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $val)
                  <h5>{{ $val }}</h5>
                @endforeach
              </div>
            @endif
            @if (session('message'))
              <div class="alert alert-success" role="alert">{{session('message')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Add Student Details</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('storeStudentDetails') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                          <label for="email">Email Adress</label>
                          <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile No.</label>
                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="{{ old('mobile') }}">
                        </div>
                        <div class="form-group">
                          <label for="gender">Gender</label>
                          <div class="input-group">
                            <label for="m">Male</label>
                            <input type="radio" name="gender" id="m" value="M">
                            <label for="f">Female</label>
                            <input type="radio" name="gender" id="f" value="F">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="img">Upload Image</label>
                          <input type="file" name="img" id="img">
                          <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection