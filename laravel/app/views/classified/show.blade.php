@extends('layouts.default') 
@section('content')
<div class="listing-post">
    <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <a href="{{ URL::previous() }}"><h1>Classifieds &middot;&nbsp;</a></h1>
        </div>
    </div>
    <div class="grey-bg-hdr" style="padding: 0; background: none;">
        <div class="main-header">
            <h1>&nbsp;{{$classified->name}}</h1>
        </div>
    </div>
    @if(Auth::check() && $classified->user_id == Auth::user()->id)
            <a href="{{ URL::route('listing.edit', array('id' => $classified->id))}}"><button class="btn btn-primary" type="button" style="float: right; margin-right: 5px;"><span class="glyphicon glyphicon-pencil"></span></button></a>
        @endif
    <hr style="margin-bottom: 0; margin-top: -5px;">
    <table class="listing-post-top">
        <tr>
            <th><img width="20px" height="auto" src="<?php echo asset('images/cat.svg')?>"></th>
            <th style="font-size: 16px; padding-left: 5px;">{{$classified->category->name}}</th>
        </tr>
        <tr>
            <td><img width="20px" height="auto" src="<?php echo asset('images/pin.svg')?>"></td>
            <?php $location = Location::find($classified->location); ?>
                <td style="font-size: 16px; font-weight: bold; padding-left: 5px;">{{ $location->suburb }}, {{ $location->state }} {{ $location->postcode }}</td>
        </tr>
    </table>
    <hr>
    <div class="listing-post-wrapper">
        <ul class="pgwSlideshow">
            @foreach(ClassifiedPhoto::where('classified_id', '=', $classified->id)->get() as $photo)
            <li><img src="<?php echo asset($photo->getPhoto($photo->photo_id)->mid)?>"></li>
            @endforeach
        </ul>
        <div class="details-wrapper">
            <div class="column-widget">
                <header class="header">
                    <h2>Details</h2></header>
            </div>
            <table class="details-inner" style="width: 50%;">
                <tr>
                    <th><span class="detail">Price:</span></th>
                    <th><span class="value">${{$classified->price}}</span></th>
                </tr>
                <tr>
                    <th><span class="detail">Condition:</span></th>
                    <th><span class="value">{{$classified->item_condition}}</span></th>
                </tr>
                <tr>
                    <th><span class="detail">Posted by:</span></th>
                    <th><span class="value">{{$classified->poster_name}} &middot; <a href="{{ URL::route('profile', array('username' => $classified->owner->username)) }}">(View Profile)</a></span></th>
                </tr>
                <tr>
                    <th><span class="detail">Contact Number:</span></th>
                    <th><span class="value">
                    @if($classified->number_public == 1)
                    {{$classified->phone_number}}
                    @else
                    <?php
                    for($i = 0; $i < strlen($classified->phone_number)-3; $i++) {
                    echo'X';
                    } ?>
                    {{ substr($classified->phone_number, -3) }} (Show Number)
                    @endif
                    </span></th>
                </tr>
                <tr>
                    <th><span class="detail">Contact Email:</span></th>
                    <th><span class="value">@if($classified->email_public == 1) {{$classified->email}} @else The poster has hidden their email address. @endif</span></th>
                </tr>
            </table>
        </div>

        <div class="details-wrapper" style="padding-top: 10px;">
            <div class="column-widget">
                <header class="header">
                    <h2>Description</h2></header>
            </div>
            <span class="desc"><p style="margin-top: 5px;">{{ nl2br(BBCode::parse($classified->description)) }}</p></span>
        </div>

        <hr>
        <div style="-webkit-filter: grayscale(100%); filter: grayscale(100%);">
            <iframe style="margin-top: 15px;" src="https://www.google.com/maps/embed/v1/place?q={{ $location->suburb }}, {{ $location->state }} {{ $location->postcode }}&zoom=12&key=AIzaSyADO9jTPFrStLLnHAX7r9Ynf3UOxUu2s1M" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen>
        </iframe>
        </div>
        <div class="column-widget" style="margin-top: 15px;">
            <header class="header">
                <h2>You may also be interested in...</h2></header>
        </div>
        <?php
        $radius = Location::getLocationsInRadius($classified->dblocation->lat, $classified->dblocation->lon, 20);
        $results = Classified::whereRaw("MATCH(name) AGAINST(?)", array($classified->name))->whereIn('location', array_pluck($radius, 'id'))->where('id', '!=', $classified->id)->take(3)->get();
        ?>
            @if($results->count() == 0) No similar classifieds found. @endif
            @foreach($results as $result)
            <a href="{{URL::route('listing', array('id' => $result->id))}}">
                <div class="clsfs-item" style="margin-top: 10px;">
                    <div class="clsfs-headerbox">
                        {{ $result->name }}
                        <span style="float: right; font-size: 14px; ">Posted by {{ $result->owner->name }} on {{ $result->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="clsfs-datacontainer">
                        <div class="clsfs-photo">
                            <div class="clsfs-photo-inner" style="background-image: url('<?php echo asset($result->getPhoto($result->id)->mid)?>');"></div>
                        </div>
                        <div class="clsfs-info">

                            <div class="clsfs-info-col">
                                <img src="../images/status.svg" width="20" height="20">
                            </div>
                            <div class="clsfs-info-col">
                                {{$result->item_condition}}
                            </div>
                            <div class="clsfs-info-ro"></div>
                            <div class="clsfs-info-col">
                                <img src="../images/price-tag.svg" width="20" height="20">
                            </div>
                            <div class="clsfs-info-col">
                                ${{$result->price}}
                            </div>
                            <div class="clsfs-info-ro"></div>
                            <div class="clsfs-info-col">
                                <img src="../images/world-location.svg" width="20" height="20">
                            </div>
                            <div class="clsfs-info-col">
                                <?php $location = Location::find($result->location); ?>
                                    {{ $location->suburb }}, {{ $location->state }} {{ $location->postcode }}
                            </div>
                            <div class="clsfs-info-ro"></div>
                            <div class="clsfs-desc">
                                {{$result->brief_desc}}
                            </div>


                        </div>
                    </div>
                </div>
            </a>
            @endforeach
    </div>
</div>
<link href="<?php echo asset('css/plugins/pgw/pgwslideshow.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/pgw/pgwslideshow.min.js')?>"></script>
<script src="<?php echo asset('js/misc/slider-init.js')?>"></script>
@stop