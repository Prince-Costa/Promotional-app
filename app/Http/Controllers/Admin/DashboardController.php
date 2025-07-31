<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BioData;
use App\Models\Driver;
use App\Models\Parking;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(){
      return view('admin.dashboard');
  }
}
