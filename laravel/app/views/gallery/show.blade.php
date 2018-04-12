@extends('layouts.default')
@section('content')
   <div class="create-thread">
    <div class="row">
        <div class="col-md-12" style="">
            <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <a href="{{ URL::previous() }}"><h1>Galleries &middot;&nbsp;</a></h1>
        </div>
        </div>
         <div class="grey-bg-hdr" style="padding: 0; background: none;">
        <div class="main-header">
            <h1>&nbsp;{{ $gallery->name }}</h1>
        </div>
       </div>
        @if(Auth::check() && $gallery->user->id == Auth::user()->id)
            <a href="{{ URL::route('gallery.edit', array('id' => $gallery->id))}}"><button class="btn btn-primary" type="button" style="float: right; margin-right: 5px;"><span class="glyphicon glyphicon-pencil"></span></button></a>
        @endif
        <hr> 
        <p></p>
        <div class="gallery-author">Posted by <strong>{{ $gallery->user->username }}</strong> on <strong>{{ $gallery->created_at->format('d/m/Y') }}</strong></div>
        @if(Session::get('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div><p></p>
        @endif
        @if(GalleryPhoto::where('gallery_id', '=', $gallery->id)->count() == 0)
            <div class="alert alert-info">There are no photos to display - the creator of this gallery most likely hasn't uploaded any photos yet. Check back later.</div>
        @endif
         <ul class="pgwSlideshow">
            @foreach(GalleryPhoto::where('gallery_id', '=', $gallery->id)->get() as $photo)
            <li><img data-description="{{ $photo->caption }}" src="<?php echo asset($photo->getPhoto($photo->photo_id)->large)?>"></li>
            @endforeach
        </ul>
        </div>
    </div>
</div>
<link href="<?php echo asset('css/plugins/pgw/pgwslideshow.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/pgw/pgwslideshow.min.js')?>"></script>
<script src="<?php echo asset('js/misc/slider-init.js')?>"></script>
 <?php
    if(GalleryView::where('ip_address', '=', getIPAddress())->count() < 1) { 
        $view = new GalleryView;
        $view->gallery_id = $gallery->id;
        if(Auth::check()) { $view->user_id = Auth::user()->id; }
            $view->ip_address = getIPAddress();
            $view->save();
    }
?>
@stop