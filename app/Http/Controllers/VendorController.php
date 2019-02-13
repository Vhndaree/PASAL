<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Vendor;
use DB;

class VendorController extends Controller
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
        $vendor= Vendor::all();
        return view('vendor.index')->with('vendor',$vendor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'contact'=>'required'
        ]);
        //create new vendor
        $vendor=new vendor;

        //fetch data from from and store it to table vendor
        $vendor->name=$request->input('name');
        $vendor->address=$request->input('address');
        $vendor->contact_no=$request->input('contact');
        $vendor->user_id=auth()->user()->id;
        $vendor->save();
        //redirect to vendor entry with success message session
        return redirect('/vendor/create') -> with('success',$request->input('name').' added to vendor-list successfully.');
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
        $new = Vendor::find($id);
        return view('vendor.edit',compact('new','id'));
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
        //validate
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'contact'=>'required'
        ]);
        $vendor=Vendor::find($id);
        //fetch data from from and store it to table vendor
        $vendor->name=$request->input('name');
        $vendor->address=$request->input('address');
        $vendor->contact_no=$request->input('contact');
        $vendor->user_id=auth()->user()->id;
        $vendor->save();
        //redirect to vendor entry with success message session
        return redirect('/vendor/create') -> with('success','Vendor-list updated successfully as '.$request->input('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor=Vendor::find($id);
        $vendor->delete();

        return redirect('/posts/vendor')->with('Success','Vendor deleted');
    }
}