<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Carbon;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function main()
    {
        $date=new Carbon\carbon;
        
        $sales=DB::table('sales')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $purchases=DB::table('purchases')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_amount) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $stocks=DB::table('stocks')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(quantity) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $items=DB::table('items')->count('id');

        return view('home',['sales'=>$sales, 'purchase'=>$purchases,'stock'=>$stocks, 'item'=>$items]);
    }

     public function index()
    {
        $user = Auth::user();

        $date=new Carbon\carbon;
        
        $sales=DB::table('sales')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $purchases=DB::table('purchases')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_amount) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $stocks=DB::table('stocks')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(quantity) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $items=DB::table('items')->count('id');

        if($user->hasAnyRole(['admin','manager']))

            return view('dashboard',['sales'=>$sales, 'purchase'=>$purchases,'stock'=>$stocks, 'item'=>$items]);

        else
            return view('home',['sales'=>$sales, 'purchase'=>$purchases,'stock'=>$stocks, 'item'=>$items]);
    }

    //https://github.com/spatie/laravel-permission#installation
    public function createRoles() {
        error_log("calling createRoles ...");
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleManager = Role::create(['name' => 'manager']);
        $roleOfficer = Role::create(['name' => 'officer']);

        $permissionCreate = Permission::create(['name' => 'create entry']);
        $permissionUpdate = Permission::create(['name' => 'update entry']);
        $permissionDelete = Permission::create(['name' => 'delete entry']);
        $permissionShowRecord = Permission::create(['name' => 'show record']);
        $permissionShowReport = Permission::create(['name' => 'show report']);
        $permissionRegisterUser = Permission::create(['name' => 'register user']);

        $roleAdmin->givePermissionTo(Role::all());
        $roleManager->givePermissionTo($permissionCreate, $permissionUpdate, $permissionDelete, $permissionShowReport);
        $roleOfficer->givePermissionTo($permissionCreate, $permissionUpdate);

        error_log("finished calling createRoles ...");

        return view('home');
    }

    public function testRoleAssign()
    {
        $date=new Carbon\carbon;
        
        $sales=DB::table('sales')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $purchases=DB::table('purchases')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_amount) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $stocks=DB::table('stocks')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(quantity) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $items=DB::table('items')->count('id');

        //$role = Role::findByName('writer');
        error_log("calling assignRoles ...");
        $user = User::find('1');

        error_log("calling assignRoles ..." . $user);

        error_log("calling assignRoles ...".$user);

        $user->assignRole('admin');
        error_log($user);
        return view('dashboard',['sales'=>$sales, 'purchase'=>$purchases,'stock'=>$stocks, 'item'=>$items]);

    }

    public function RoleAssignManager()
    {
        $date=new Carbon\carbon;
        
        $sales=DB::table('sales')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $purchases=DB::table('purchases')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_amount) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $stocks=DB::table('stocks')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(quantity) as total'))
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $items=DB::table('items')->count('id');

        $manager = User::find('2');
        error_log(" assignRoles ..." . $manager);
        $manager->assignRole('manager');
        error_log($manager);

        return view('dashboard',['sales'=>$sales, 'purchase'=>$purchases,'stock'=>$stocks, 'item'=>$items]);

    }
    
}
