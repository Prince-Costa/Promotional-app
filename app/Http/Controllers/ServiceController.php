<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::all();

        return view('front.service.index', compact( 'services'));
    }

    public function show($id){
        $service = Service::find($id);
        if(!$service) {
            abort(404);
        }
        $services = Service::all();

        $packages = $service->packages()->get()->groupBy('tag');
   
        return view('front.service.show', compact('service', 'services', 'packages'));
    }
}
