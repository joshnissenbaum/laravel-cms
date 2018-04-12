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
    <div class="row writer">
        <div class="col-md-4">
            @include('profile.writer.sidebar')
        </div>
        
        <div class="col-md-8">
            <?php if($nav == 'profile.writer.home') { ?>
            <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 16px;"><span class="glyphicon glyphicon-inbox"></span>&nbsp; Submission Center</h2></header>
            </div>
            @include('profile.writer.center')
            
            <?php } ?>
        
            <?php if($nav == 'profile.writer.new') { ?>
            <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 16px;"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp; Post an Article</h2></header>
            </div>
            @include('profile.writer.new')
            <?php } ?>
                    
             <?php if($nav == 'profile.writer.faq') { ?>
            <div class="column-widget" style="margin-bottom: 5px;">
                <header class="header" style="margin-bottom: 0; padding: 0;"><h2 style="font-size: 16px;"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; FAQ & Support</h2></header>
            </div>
            @include('profile.writer.faq')
            <?php } ?>
        </div>
    </div>
</div>
@stop