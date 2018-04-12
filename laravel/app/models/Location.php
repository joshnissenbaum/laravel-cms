<?php

class Location extends Eloquent {
    
	protected $table = 'postcode_db';
    
    public function classified()
    {
        return $this->hasMany('Classified', 'location');
    }
    
    public function scopegetLocationsInRadius($query, $lat, $lon, $km)
    {
        $radius = DB::select('SELECT `id`,`postcode`,`suburb`,`state`, ACOS( SIN( RADIANS( `lat` ) ) * SIN( RADIANS( '.$lat.' ) ) + COS( RADIANS( `lat` ) )
        * COS( RADIANS( '.$lat.' )) * COS( RADIANS( `lon` ) - RADIANS( '.$lon.' )) ) * 6380 AS `distance`
        FROM `postcode_db`
        WHERE
        ACOS( SIN( RADIANS( `lat` ) ) * SIN( RADIANS( '.$lat.' ) ) + COS( RADIANS( `lat` ) )
        * COS( RADIANS( '.$lat.' )) * COS( RADIANS( `lon` ) - RADIANS( '.$lon.' )) ) * 6380 < '.$km.'
        ORDER BY `distance`');
        return $radius;
    }

}

?>