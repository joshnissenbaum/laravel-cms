@extends('layouts.default')
@section('content')
   <div class="clsfsfront-wrapper">
    <div class="clsfs-search">
        <div class="clsfs-search-col">
            {{ Form::open(array('action' => 'ClassifiedsController@search', 'id' => 'searchclassifieds')) }}
            <input name="keywords" id="keywords" type="text" style="width:92%;" placeholder="Keywords (rocket cover housing, seat rail)">
            <span class="price">
        <select name="price-min" style="width: 45.5%">
        <option>Price Min</option>
        <option>0</option>
        <option>50</option>
        <option>100</option>
        <option>200</option>
        <option>500</option>
        <option>1000</option>
        <option>2000</option>
        <option>5000</option>
        <option>10000</option>
        <option>50000</option>
        <option>100000</option>
        </select>
        <select name="price-max" style="width: 45.5%">
        <option>Price Max</option>
        <option>50</option>
        <option>100</option>
        <option>200</option>
        <option>500</option>
        <option>1000</option>
        <option>2000</option>
        <option>5000</option>
        <option>10000</option>
        <option>50000</option>
        <option>100000</option>
        </select> 
        </span>

        </div>

        <div class="clsfs-search-col">
            <select name="location" id="location" style="width: 49.5%; display: inline-block;" data-placeholder="All Locations">
            <option value="" selected="selected">All Locations</option>
            </select>
             <select name="radius" id="radius" style="width: 49.5%; display: inline-block;" placeholder="Location">
             <option value="1.5">+ 0 km</option>
             <option value="2">+ 2 km</option>
             <option value="5">+ 5 km</option>
             <option value="10">+ 10 km</option>
             <option value="20">+ 20 km</option>
             <option value="50">+ 50 km</option>
             <option value="250">+ 250 km</option>
             <option value="500">+ 500 km</option>
            </select>
            <select name="category" id="category" style="width: 100%; margin-top: 15px;">
                <option value="0">All Categories</option>
                @foreach(ClassifiedCategory::all() as $cat)
                <option value="{{ $cat->id }}">{{$cat->name}}</option>
                @endforeach
            </select>

        </div>

    </div>
    <div class="clsfs-search-btn">
        <input type="submit" value="">
    </div>
    {{ Form::close() }}
</div>
<link href="<?php echo asset('css/plugins/select2/select2.css')?>" rel="stylesheet">
<script src="<?php echo asset('js/plugins/select2/select2.js')?>"></script>
<script src="<?php echo asset('js/misc/location-init.js')?>"></script>
@stop