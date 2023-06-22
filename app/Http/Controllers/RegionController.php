<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Region_name;

class RegionController extends Controller
{
    public function new(){
        $regions = Region_name::all();
        return view("new_region",compact('regions'));
    }
}
