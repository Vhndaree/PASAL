<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\chartsSales;
use App\Charts\PieDougnut;
use DB;
use Carbon;

class ChartController extends Controller
{
    public static function line(){
        $date = new Carbon\Carbon;
        
        $sales=DB::table('sales')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
        ->groupBy('date')
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();

        $purchases=DB::table('purchases')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_amount) as total'))
        ->groupBy('date')
        ->where(DB::raw('DATE(created_at)'),'>',$date->subDays(7)->toDateTimeString())
        ->get();
        
        $date=array();
        $sale=array();
        $purchase=array();
        foreach($sales as $a){
            $date[]=$a->date;
            $sale[]=$a->total;
        }
        foreach($purchases as $b){
            $purchase[]=$b->total;
        }
        if($sale==true && $purchase==true){
        $chart = new chartsSales;
        $chart->labels($date);
        $chart->dataset('Sales of the week', 'line', $sale)->color('#457695');
        $chart->dataset('Purchase of the week', 'line', $purchase)->color('#956874'); 

        echo $chart->container();
        echo $chart->script();
        }
        else{
            echo"<div class='card'>No data available for now.</div>";
        }

    }
}
