<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Item;
use DB;

class ItemController extends Controller
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
        $item=Item::all();
        return view('item.index')->with('item',$item);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
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
            'name'=>'required',
            'unit'=>'required'
        ]);
        //create new item
        $item=new Item;

        //save input data to the Item table in database
        $item->name=$request->input('name');
        $item->unit=$request->input('unit');
        $item->user_id=auth()->user()->id;
        $item->save();

        return redirect('/item/create') -> with('success',$request->input('name').' added to item-list successfully.');
        //
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
        $new = Item::find($id);
        return view('item.edit', compact('new','id'));
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
        $item=Item::find($id);
        //validation
        $this->validate($request,[
            'name'=>'required',
            'unit'=>'required'
            ]);
        //save input data to the Item table in database
        $item->name=$request->input('name');
        $item->unit=$request->input('unit');
        $item->save();
       
        return redirect('posts/item') -> with('success','item updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Item::find($id);
        $item->delete();

        return redirect('posts/item') -> with('Success','Item removed');
    }
}
