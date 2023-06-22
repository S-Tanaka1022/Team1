<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Region_name;


class UserController extends Controller
{
    public function index()
    { {
            $user_id = auth()->user()->id;
            $regions = Region_name::all();
            $fav_regions = Region::where('user_id', "$user_id")->get();

            return view('index', compact('regions', 'fav_regions'));
        }
    }
}
