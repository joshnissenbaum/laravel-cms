@extends('layouts.default')
@section('content')
<div class="galleries">
    <div class="column-widget" style="margin-bottom: 5px;">
        <header class="header">
        <h2><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp; Featured Galleries</h2>
        </header>
    </div>
   <div class="row">
   @foreach(Gallery::where('featured', '=', '1')->get() as $gallery)
       <div class="col-md-4">
        <a href="{{ URL::route('gallery', array('id' => $gallery->id))}}">
        <div class="grid-item">
            <div class="grid-info">
                <div class="grid-info-author"><span style="font-size: 15px; font-weight: bold;">{{$gallery->name }}</span><br>Posted by {{ $gallery->user->username }} on {{$gallery->created_at->format('j M Y') }}</div>
            </div>
        <div class="grid-img" style="background-image: url('{{ asset($gallery->getPhoto($gallery->displayphoto_id)->mid) }}')"></div>
        </div>
        </a>
        </div>
    @endforeach
   </div>
   <div class="column-widget" style="margin-bottom: 5px; margin-top: 10px;">
        <header class="header">
        <h2><span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>&nbsp; Trending</h2>
        </header>
    </div>
    <div class="row">
    @foreach(Gallery::getTrending()->take(6)->get() as $gallery)
       <div class="col-md-4">
        <a href="{{ URL::route('gallery', array('id' => $gallery->id))}}">
        <div class="grid-item">
            <div class="grid-info">
                <div class="grid-info-author"><span style="font-size: 15px; font-weight: bold;">{{$gallery->name }}</span><br>Posted by {{ $gallery->user->username }} on {{$gallery->created_at->format('j M Y') }}</div>
            </div>
        <div class="grid-img" style="background-image: url('{{ asset($gallery->getPhoto($gallery->displayphoto_id)->mid) }}')"></div>
        </div>
        </a>
        </div>
    @endforeach
    </div>
    <div class="column-widget" style="margin-bottom: 5px; margin-top: 10px;">
        <header class="header">
        <h2><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>&nbsp; Recently Added</h2></header>
    </div>
    <div class="row">
    @foreach(Gallery::orderBy('created_at', 'DESC')->take(3)->get() as $gallery)
       <div class="col-md-4">
        <a href="{{ URL::route('gallery', array('id' => $gallery->id))}}">
        <div class="grid-item">
            <div class="grid-info">
                <div class="grid-info-author"><span style="font-size: 15px; font-weight: bold;">{{$gallery->name }}</span><br>Posted by {{ $gallery->user->username }} on {{$gallery->created_at->format('j M Y') }}</div>
            </div>
        <div class="grid-img" style="background-image: url('{{ asset($gallery->getPhoto($gallery->displayphoto_id)->mid) }}')"></div>
        </div>
        </a>
        </div>
    @endforeach
    </div>
    <div class="column-widget" style="margin-bottom: 5px; margin-top: 10px;">
        <header class="header">
        <h2><span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>&nbsp; Random</h2></header>
    </div>
    <div class="row">
    @foreach(Gallery::orderByRaw('RAND()')->get() as $gallery)
       <div class="col-md-4">
        <a href="{{ URL::route('gallery', array('id' => $gallery->id))}}">
        <div class="grid-item">
            <div class="grid-info">
                <div class="grid-info-author"><span style="font-size: 15px; font-weight: bold;">{{$gallery->name }}</span><br>Posted by {{ $gallery->user->username }} on {{$gallery->created_at->format('j M Y') }}</div>
            </div>
        <div class="grid-img" style="background-image: url('{{ asset($gallery->getPhoto($gallery->displayphoto_id)->mid) }}')"></div>
        </div>
        </a>
        </div>
    @endforeach 
    </div>
    
</div>
@stop