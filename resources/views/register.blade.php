@extends('master')
@section('content')
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="register" method="POST">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">User Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">  
              </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">  
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Register</button>
              </form>
        </div>
    </div>  
</div>
@endsection
