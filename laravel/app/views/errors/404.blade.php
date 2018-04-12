@extends('layouts.default')
@section('content')
<div class="jumbotron" style="background-image: url({{ asset('images/404.jpg') }}); text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
             0px 8px 13px rgba(0,0,0,0.1),
             0px 18px 23px rgba(0,0,0,0.1);">
  <h1>404 &middot; Page Not Found</h1>
  <p style="color: white;">The page may have been deleted or archived. If this is an error, please contact support@e30aus.com immediately.</p>
</div> 
@stop