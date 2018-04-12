<div class="top-articles" style="margin-top: 15px;">
    <a href="{{ URL::route('articles') }}">
    <div class="column-widget">
    <header class="header">
    <h2><img width="20" height="auto" src="<?php echo asset('images/gallery.svg')?>">&nbsp; Trending Galleries</h2></header>
    </div> 
    </a>
    @foreach(Gallery::getTrending()->take(5)->get() as $gphoto)
    <a href="{{ URL::route('gallery', array('$id' => $gphoto->id)) }}">
        <div class="tren-item animated fadeInUp">
            <div class="tren-item-img" style="background-image: url('<?php echo asset($gphoto->getPhoto($gphoto->displayphoto_id)->mid)?>');">
            </div>
            <div class="tren-item-text">
                {{ $gphoto->name }}
            </div>
            <div class="tren-item-author">
                Posted {{ $gphoto->created_at->format('d F') }} by {{$gphoto->user->username}}
            </div>
        </div>
    </a>
    @endforeach
</div>