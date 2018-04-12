@extends('layouts.default')
@section('content')
 <div id="login-success" class="jumbotron">
  <h1>Welcome.</h1>
</div> 
<div class="login-page">
<div class="row" style="margin-left: 0; margin-right: 0;">
  <div class="col-md-5" style="background-color: #E5E5E5; padding: 20px;">
      <div class="column-widget">
        <header class="header">
        <h2>Login</h2></header>
     </div>
      <div id="login-error" class="alert alert-danger"></div>
      {{ Form::open(array('action' => 'UserController@loginUser', 'id' => 'loginForm')) }}
           <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <div class="input-group">
             <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
            <input type="text" class="form-control" id="username" name="username" placeholder="">
          </div>
          </div>
           <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <div class="input-group">
             <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="">
          </div>
          </div>
        <div class="checkbox">
        <label>
          <input id="stay_signed" name="stay_signed" type="checkbox" value="yes">Remember Me
        </label>
      </div>
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp; Login</button>
      {{ Form::close() }}
      <p></p><br><hr><p></p>
        <div class="spacer"></div>
  </div>
    
  <div class="col-md-7" style="background-color: #D7D7D7; padding: 20px;">
      <div class="column-widget">
        <header class="header">
        <h2>Register</h2></header>
     </div>
      <div id="create-error" class="alert alert-danger"></div>
     {{ Form::open(array('action' => 'UserController@createUser', 'id' => 'createUserForm')) }}
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="joeblow@mail.org">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
  </div>
        <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Re-type password">
  </div>
  <p></p>
  <div class="g-recaptcha" data-sitekey="6LdxSygTAAAAABadcUg5YRKfKqiZK6a6VuYNICdp"></div><p></p>        
  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp; Register</button>
   {{ Form::close() }}
      
    
  </div>
</div>
</div>
<script src="<?php echo asset('js/user/login.js')?>"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop