<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sale;
use App\Stock;
use DB;

class SaleController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales= DB::table('sales')
              ->join('items','sales.item_id','=','items.id')
              ->join('vendors','sales.vendor_id','=','vendors.id')
              ->select('sales.id','sales.user_id','sales.user_id','sales.created_at','sales.quantity','sales.amount','items.name as item_name','items.unit','vendors.name as vendor_name')
              ->get();

        return view('sales.index')->with('sales',$sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $this->validate($request,[
            'item_name'=>'required | numeric',
            'vendor_name'=>'required | numeric',
            'quantity'=>'required | numeric'
        ]);
        $unitprice=DB::table('purchases')->where('item_id','=',$request->input('item_name'))->where('vendor_id','=',$request->input('vendor_name'))->latest()->get();
        //create new sadle instance
        $sale=new Sale;

        //fetch and store data from sales table
        $sale->item_id=$request->input('item_name');
        $sale->vendor_id=$request->input('vendor_name');
        $sale->user_id=auth()->user()->id;
        $sale->unitprice=$unitprice[0]->unitprice*1.12;
        $sale->quantity=$request->input('quantity');
        $sale->amount=($unitprice[0]->unitprice*1.12)*$request->input('quantity');
        $sale->save();

        //for stock
        $stock=new Stock;
        if($updateStock=Stock::where('vendor_id',$request->get('vendor_name'))->where('item_id',$request->get('item_name'))->first()){
            $updateStock->quantity=$updateStock->quantity-$request->input('quantity');
            $updateStock->save();
            
            //redirect to sales entry table with session message
            return redirect('/sales/create')->with('success',DB::table('items')->where('id',(int)$request->get('item_name'))->value('name').' recorded in sales entry');
            }else{
            return redirect('/sales/create')->with('error','The item you want to buy is out of stock');
            }
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = Sale::find($id);
        return view('sales.edit',compact('new','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//Update matter is not solved
    {
        //Validation
        $this->validate($request,[
            'item_name'=>'required | numeric',
            'vendor_name'=>'required | numeric',
            'quantity'=>'required | numeric'
        ]);
        $unitprice=DB::table('purchases')->where('item_id','=',$request->input('item_name'))->where('vendor_id','=',$request->input('vendor_name'))->latest()->get();
        
        $sale=Sale::find($id);
        $oldvalue=$sale->quantity;
        //fetch and store data from sales table
        $sale->item_id=$request->input('item_name');
        $sale->vendor_id=$request->input('vendor_name');
        $sale->user_id=auth()->user()->id;
        $sale->unitprice=$unitprice[0]->unitprice*1.12;
        $sale->quantity=$request->input('quantity');
        $sale->amount=($unitprice[0]->unitprice*1.12)*$request->input('quantity');
        $sale->save();

        if($updateStock=Stock::where('vendor_id',$request->get('vendor_name'))->where('item_id',$request->get('item_name'))->first()){
            $updateStock->quantity=$updateStock->quantity-$request->input('quantity')+$oldvalue;
            $updateStock->save();
        }

        //redirect to sales entry table with session message
        return redirect('/sales/create') -> with('success','Sales-list successfully updated as '.DB::table('items')->where('id',(int)$request->get('item_name'))->value('name'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sales=sale::find($id); 
        $sales->delete();

        return redirect('/posts/sales')->with('Success','Sales deleted');
    }
}
