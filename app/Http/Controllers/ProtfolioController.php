<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class ProtfolioController extends Controller
{
    public function show($id)
    {
        $portfolio = Portfolio::find($id);
        if(!$portfolio) {
            abort(404);
        }
        $portfolios = Portfolio::all();
        return view('front.portfolio.show', compact('portfolio', 'portfolios'));
    }
}
