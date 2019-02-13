<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablesController extends Controller
{
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addVendor(){
        return view('vendor.create');
    }
    public function addItem(){
        return view('item.create');
    }
    public function addPurchase(){
        return view('purchase.create');
    }
    public function  addSales(){
        return view('sales.create');
    }
}
