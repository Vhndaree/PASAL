<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Purchase;
use App\Stock;

class PurchaseController extends Controller
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
        $purchase=DB::table('purchases')
                  ->join('items','purchases.item_id','=','items.id')
                  ->join('vendors','purchases.vendor_id','=','vendors.id')
                  ->select('purchases.id','items.name as item_name','items.unit','vendors.name as vendor_name','purchases.unitprice','purchases.quantity','purchases.total_amount','purchases.user_id')
                  ->get();
        return view('purchase.index')->with('purchase',$purchase);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->get('name'), $request->get('vendor'));
        
        //Validate data
        $this->validate($request,[
            'name'=>'required | numeric',
            'vendor'=>'required | numeric',
            'unitprice'=>'required | numeric',
            'quantity'=>'required | numeric'
        ]);

        //create new purchace
        $purchase=new Purchase;

        //fetch data from form and store to table Purchase
        $purchase->item_id=(int)$request->get('name');
        $purchase->vendor_id=(int)$request->get('vendor');        
        $purchase->user_id=auth()->user()->id;
        $purchase->unitprice=$request->input('unitprice');
        $purchase->quantity=$request->input('quantity');
        $purchase->total_amount=floatval($request->input('unitprice'))*floatval($request->input('quantity'));
        if($request->get('mfg_date')){
            $purchase->mfg_date=$request->get('mfg_date');
            $purchase->expiry_date=date('Y-m-d', strtotime($request->get('mfg_date'). ' + '.$request->get('validity').' days'));
        }
        $purchase->save();
        if($updateStock=Stock::where('vendor_id',$request->get('vendor'))->where('item_id',$request->get('name'))->first()){
            $updateStock->quantity=$updateStock->quantity+$request->input('quantity');
            $updateStock->save();
        }else{
            $stock=new Stock;
            $stock->item_id=(int)$request->get('name');
            $stock->vendor_id=(int)$request->get('vendor'); 
            $stock->quantity=$request->input('quantity');
            $stock->save();
        }
        //redirect to desired place
        return redirect('/purchase/create') -> with('success',DB::table('items')->where('id',(int)$request->get('name'))->value('name').' added to Purchase-list successfully.');
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
        $new = Purchase::find($id);
        return view('purchase.edit',compact('new', 'id'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $this->validate($request,[
            'name'=>'required',
            'unitprice'=>'required | numeric',
            'quantity'=>'required | numeric'
        ]);

        $purchase=Purchase::find($id);
        $oldvalue=$purchase->quantity;
        //fetch data from form and store to table Purchase
        $purchase->item_id=(int)$request->get('name');
        $purchase->vendor_id=(int)$request->get('vendor');        
        $purchase->user_id=auth()->user()->id;
        $purchase->unitprice=$request->input('unitprice');
        $purchase->quantity=$request->input('quantity');
        $purchase->total_amount=floatval($request->input('unitprice'))*floatval($request->input('quantity'));
        if($request->get('mfg_date')){
            $purchase->mfg_date=$request->get('mfg_date');
            $purchase->expiry_date=date('Y-m-d', strtotime($request->get('mfg_date'). ' + '.$request->get('validity').' days'));
        }
        $purchase->save();
        
        if($updateStock=Stock::where('vendor_id',$request->get('vendor'))->where('item_id',$request->get('name'))->first()){
            $updateStock->quantity=$updateStock->quantity+$request->input('quantity')-$oldvalue;
            $updateStock->save();
        }
        //redirect to desired place
        return redirect('/purchase/create') -> with('success','Purchase-list successfully updated as '.DB::table('items')->where('id',(int)$request->get('name'))->value('name'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase=Purchase::find($id);
        $purchase->delete();

        return redirect('/posts/purchase')-> with('Success','Purchase deleted');
    }
}
