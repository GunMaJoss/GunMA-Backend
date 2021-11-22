<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index (){
        return Location::orderBy('id','DESC')->get();

    }

    public function search ($name){
        return Location::where('locationName','like','%'.$name.'%')->get();

    }





}
