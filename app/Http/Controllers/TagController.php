<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index (){

        return Tag::orderBy('id','DESC')->get();
    }


    public function search ($name){
        return Tag::where('tagName','like','%'.$name.'%')->get();

    }



    //
}
