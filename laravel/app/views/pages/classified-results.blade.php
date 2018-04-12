<?php 
if($_GET['pricemin'] == 'Price Min') { $pricemin = "0"; } else { $pricemin = $_GET['pricemin']; } 
if($_GET['pricemax'] == 'Price Max') { $pricemax = "100000"; } else { $pricemax = $_GET['pricemax']; } 
    if($_GET['category'] == 0 && !$_GET['location'] == "")
    {
        $location = Location::where('id', '=', $_GET['location'])->first();
        $radius = Location::getLocationsInRadius($location->lat, $location->lon, $_GET['radius']);
        $results = Classified::where('name', 'LIKE', '%'. $_GET['keywords'] . '%')
        ->whereBetween('price', array($pricemin, $pricemax))
        ->whereIn('location', array_pluck($radius, 'id'))
        ->orderBy('created_at', 'DESC');
    }
    if($_GET['category'] == 0 && $_GET['location'] == "")
    {
        $results = Classified::where('name', 'LIKE', '%'. $_GET['keywords'] . '%')
        ->whereBetween('price', array($pricemin, $pricemax))
        ->orderBy('created_at', 'DESC');
    }
    if(!$_GET['category'] == 0 && !$_GET['location'] == "")
    {
        $location = Location::where('id', '=', $_GET['location'])->first();
        $radius = Location::getLocationsInRadius($location->lat, $location->lon, $_GET['radius']);
        $results = Classified::where('name', 'LIKE', '%'. $_GET['keywords'] . '%')
        ->whereBetween('price', array($pricemin, $pricemax))
        ->whereIn('location', array_pluck($radius, 'id'))
        ->where('category_id', '=', $_GET['category'])
        ->orderBy('created_at', 'DESC');
    }
    if(!$_GET['category'] == 0 && $_GET['location'] == "")
    {
        $results = Classified::where('name', 'LIKE', '%'. $_GET['keywords'] . '%')
        ->whereBetween('price', array($pricemin, $pricemax))
        ->where('category_id', '=', $_GET['category'])
        ->orderBy('created_at', 'DESC');
    }
    if($_GET['location'] == "" && $_GET['category'] == "")
    {
        $results = Classified::where('name', 'LIKE', '%'. $_GET['keywords'] . '%')
        ->whereBetween('price', array($pricemin, $pricemax))
        ->orderBy('created_at', 'DESC');
    }
?>
@extends('layouts.default')
@section('content')
    <div class="classifieds">
        <div class="grey-bg-hdr" style="padding: 0; padding-left: 10px; padding-right: 3px;">
        <div class="main-header">
            <a href="{{ URL::route('classifieds') }}"><h1>Classifieds &middot;&nbsp;</a></h1>
        </div>
        </div>
         <div class="grey-bg-hdr" style="padding: 0; background: none;">
        <div class="main-header">
            <h1>&nbsp;Search Results ({{ $results->get()->count() }})</h1>
        </div>
        </div>
        <hr>
        {{ Form::open(array('action' => 'ClassifiedsController@search', 'id' => 'searchclassifieds', 'class' => 'navbar-form navbar-left', 'role' => 'search', 'style' => 'width: 100%; padding: 10px; margin-top: 0px; background-color: #636363;')) }}
          <div class="col-xs-3" style="padding-left: 0; padding-right: 6px;">
         <input name="keywords" type="text" class="form-control" placeholder="I'm looking for..." style="width: 100%;" value="{{ $_GET['keywords']}}">
       </div>
       <div class="form-group">
         <select name="category" class="form-control" placeholder="All Categories" style="width: 150px;">
             @if($_GET['category'] != 0)
             <?php $cat = ClassifiedCategory::find($_GET['category']); ?>
             <option value="{{ $cat->id }}">{{ $cat->name  }}</option>
             <option value="0">All Categories</option>
             @foreach(ClassifiedCategory::where('id', '!=', $cat->id)->get() as $cc)
             <option value="{{ $cc->id}}">{{ $cc->name }}</option>
             @endforeach
             @else
             <option value="0">All Categories</option>
             @foreach(ClassifiedCategory::all() as $cc)
             <option value="{{ $cc->id}}">{{ $cc->name }}</option>
             @endforeach
             @endif
         </select>
        </div>
        <div class="form-group" style="">
         <select name="location" id="location" class="form-control" placeholder="All Locations">
          @if($_GET['location'] != "")
          <?php $location = Location::where('id', '=', $_GET['location'])->first(); ?>
          <option value="{{ $location->id}}" selected>{{ $location->suburb }} {{ $location->state }} {{ $location->postcode }}</option>
          @else
          <option value="" selected>All Locations</option>
          @endif
          </select>
          </div>
        <div class=" form-group" style="">
         <select name="radius" class="form-control">
            @if($_GET['radius'] == 1.5)
             <option value="1.5">+ 0 km</option>
             <option value="2">+ 2 km</option>
             <option value="5">+ 5 km</option>
             <option value="10">+ 10 km</option>
             <option value="20">+ 20 km</option>
             <option value="50">+ 50 km</option>
             <option value="250">+ 250 km</option>
             <option value="500">+ 500 km</option>
             @elseif($_GET['radius'] == 2)
             <option value="2">+ 2 km</option>
             <option value="1.5">+ 0 km</option>
             <option value="5">+ 5 km</option>
             <option value="10">+ 10 km</option>
             <option value="20">+ 20 km</option>
             <option value="50">+ 50 km</option>
             <option value="250">+ 250 km</option>
             <option value="500">+ 500 km</option>
             @elseif($_GET['radius'] == 5)
             <option value="5">+ 5 km</option>
             <option value="1.5">+ 0 km</option>
             <option value="2">+ 2 km</option>
             <option value="10">+ 10 km</option>
             <option value="20">+ 20 km</option>
             <option value="50">+ 50 km</option>
             <option value="250">+ 250 km</option>
             <option value="500">+ 500 km</option>
             @elseif($_GET['radius'] == 10)
             <option value="10">+ 10 km</option>
            <option value="1.5">+ 0 km</option>
             <option value="2">+ 2 km</option>
             <option value="5">+ 5 km</option>
             <option value="20">+ 20 km</option>
             <option value="50">+ 50 km</option>
             <option value="250">+ 250 km</option>
             <option value="500">+ 500 km</option>
             @elseif($_GET['radius'] == 20)
             <option value="20">+ 20 km</option>
            <option value="1.5">+ 0 km</option>
             <option value="2">+ 2 km</option>
             <option value="5">+ 5 km</option>
             <option value="10">+ 10 km</option>
             <option value="50">+ 50 km</option>
             <option value="250">+ 250 km</option>
             <option value="500">+ 500 km</option>
             @elseif($_GET['radius'] == 50)
             <option value="50">+ 50 km</option>
             <option value="1.5">+ 0 km</option>
             <option value="2">+ 2 km</option>
             <option value="5">+ 5 km</option>
             <option value="10">+ 10 km</option>
             <option value="20">+ 20 km</option>
             <option value="250">+ 250 km</option>
             <option value="500">+ 500 km</option>
             @elseif($_GET['radius'] == 250)
             <option value="250">+ 250 km</option>
             <option value="1.5">+ 0 km</option>
             <option value="2">+ 2 km</option>
             <option value="5">+ 5 km</option>
             <option value="10">+ 10 km</option>
             <option value="20">+ 20 km</option>
             <option value="50">+ 50 km</option>
             <option value="500">+ 500 km</option>
             @elseif($_GET['radius'] == 500)
             <option value="500">+ 500 km</option>
             <option value="1.5">+ 0 km</option>
             <option value="2">+ 2 km</option>
             <option value="5">+ 5 km</option>
             <option value="10">+ 10 km</option>
             <option value="20">+ 20 km</option>
             <option value="50">+ 50 km</option>
             <option value="250">+ 250 km</option>
             @endif
          </select>
          </div>
            <div class=" form-group">
         <select name="price-min" class="form-control">
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
          </div>
           <div class=" form-group">
         <select name="price-max" class="form-control">
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
          </div>
          <div class=" form-group" style="float: right;">
          <button type="submit" class="btn btn-primary">Search</button>
          </div>
        {{ Form::close() }}
        <div class="classifieds-container">
            <div class="clsfs-wrapper">
                   @if($results->get()->count() == 0)
                       <div class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span>&nbsp; We found no listings with the information you provided.</div>
                   @endif
                   <?php $results = $results->paginate(10); ?>
                   @foreach($results as $result)
                    <a href="{{URL::route('listing', array('id' => $result->id))}}">
                    <div class="clsfs-item">
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
       {{ $results->appends(Input::all())->links()}}
        @if(Auth::check())
        <header class="grey-bg-hdr" style="float: right; margin-bottom: 10px;">
        <a href="{{ URL::route('profile.writer.newad', array('username' => Auth::user()->username))}}"><span class="prim-hdr">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Post Advert</span></a>
        </header>
        @endif
        </div>
        
        <div class="right-column">
          @include('misc.general-right-column')
        </div>
    </div>
    <link href="<?php echo asset('css/plugins/select2/select2.css')?>" rel="stylesheet">
    <script src="<?php echo asset('js/plugins/select2/select2.js')?>"></script>
    <script src="<?php echo asset('js/misc/location-init.js')?>"></script>
    @stop