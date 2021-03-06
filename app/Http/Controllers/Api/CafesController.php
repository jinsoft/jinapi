<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cafe;

class CafesController extends Controller
{
    //
    public function getCafes()
    {
        //
        $cafes = Cafe::all();
        return response()->json($cafes);
    }

    public function getCafe($id)
    {
        //
        $cafe = Cafe::find($id);
        return response()->json($cafe);
    }

    public function postNewCafe()
    {
        //
        $cafe = new Cafe();
        $cafe->name = Request::get('name');
        $cafe->address = Request::get('address');
        $cafe->city = Request::get('city');
        $cafe->state = Request::get('state');
        $cafe->zip = Request::get('zip');

        $cafe->save($cafe);
        return response()->json($cafe, 201);
    }
}
