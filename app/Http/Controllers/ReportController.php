<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;

class ReportController extends Controller
{
    public function sales(){
        $sales=Sale::all();
        return view('reports.show')->with('sales',$sales);
    }
}
