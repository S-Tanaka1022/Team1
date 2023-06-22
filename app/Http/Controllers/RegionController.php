<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Region;

class RegionController extends Controller
{
    public function new(){
        $regions = Region::all();
        return view("new_region",compact('regions'));
    }
}
