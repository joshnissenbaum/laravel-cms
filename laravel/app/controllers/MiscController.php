<?php

class MiscController extends BaseController {
    public function searchLocations()
    {
        $q = Input::get('q');
        $results = Location::where('suburb', 'LIKE', '%'. $q . '%')
            ->orWhere('state', 'LIKE', '%'. $q . '%')
            ->orWhere('postcode', 'LIKE', '%'. $q . '%')
            ->get();
        return Response::json( $results ); 
    }
    public function searchUsers($query)
    {
        $results = User::select('username')->where('username', 'LIKE', '%' . $query . '%')->get();       
        return Response::json($results);
    } 
    public function siteSearch()
    {
        
    }
}
