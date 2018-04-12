@if(Classified::all()->count() > 6)
   <div class="sale-posts">
           <div class="column-widget">
    <header class="header">
    <h2><img width="20" height="auto" src="<?php echo asset('images/stand.svg')?>">&nbsp; Trending Classifieds</h2></header>
    </div> 
   <div class="fposts-wrapper animated fadeInUp">
       @foreach(Classified::orderBy('created_at', 'DESC')->get()->take(8) as $listing)
      <div class="fpost">
        <a href="{{URL::route('listing', array('id' => $listing->id))}}">
        <div class="fpost-img" style=" background-image: url('<?php echo asset($listing->getPhoto($listing->id)->thumb)?>');"></div>    
        <?php $location = Location::find($listing->location); ?>
        <div class="fpost-info">
        ${{$listing->price}} / {{ $location->state }}
        </div>     
        </a>
       </div>
    
       @endforeach
       </div>
       
       </div>     
        
    @endif
    