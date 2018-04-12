@extends('layouts.default')
@section('content')
<?php
$user = User::where('username', '=', $username)->first();
?>
<div class="profile">
    <div class="profile-cover-img" style="background-image: url('<?php echo asset($user->getPhoto($user->cover_photo)->large.'')?>');">
    <div class="profile-name">
    @include('profile.profile-name')
    </div> 
    </div>
    <div class="profile-inner">
    <div class="profile-data" style="padding-left: 0; padding-right: 0;">
        <span>
           <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 20px;">Galleries</h2>
                @if(Auth::check() && $user->id == Auth::user()->id)
            <a href="{{ URL::route('profile.addgallery', array('username' => $username))}}"><button class="btn btn-primary" type="button" style="position: absolute; right: 0;">
                <span class="glyphicon glyphicon-picture"></span>&nbsp; Create Gallery</button></a>
            @endif
                </header>
            </div>
        </span><p></p>
            @if(Gallery::where('user_id', '=', $user->id)->count() == 0)
                <div class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span>&nbsp; {{ $user->username }} has not created any galleries yet.</div>
            @else
            <div class="row">
            @foreach ($galleries = Gallery::where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->get() as $gallery)
            <a href="{{ URL::route('gallery', array('id' => $gallery->id))}}">
            <div class="col-md-3" style="margin-bottom: 20px;">
                <div class="profile-gallery-item">
                   <div class="profile-gallery-img" style="background-image: url('{{ asset($gallery->getPhoto($gallery->displayphoto_id)->mid) }}')">
                    </div>
                <div class="profile-gallery-info">
                    <span style="font-size: 14px; font-weight: bold;" href="#">{{ $gallery->name }}</span><br>
                    Created on {{ $gallery->created_at->format('j/m/Y') }} &middot; {{ GalleryPhoto::where('gallery_id', '=', $gallery->id)->count() }} photos
                    </div>
                </div>    
            </div>
            </a>
            @endforeach
            </div>
            @endif
    </div>
    </div>
</div>
@stop