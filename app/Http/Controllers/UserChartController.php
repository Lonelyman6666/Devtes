<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UserChart;

use App\Product;
use App\Report_product;
use App\Store_area;
use App\Product_brand;

class UserChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(!empty($request)){
            $areas = Store_area::all();
            $brands = Product_brand::all();
            // $compliance = Report_product::join('store','report_product.store_id','=','store.store_id')
            //             ->where('store.area_id',5)->sum('compliance');

            return view('barchart',compact('areas','brands'));
        }else{
            // $areas = Store_area::all();
            // $brands = Product_brand::all();
            // $selectarea = $request->area;
            // $start = $request->start;
            // $end = $request->end;
            //     return view('barchart2',compact('areas','brands','selectarea'.'start','end'));
            echo "data ada";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $areas = Store_area::all();
            $brands = Product_brand::all();
            $selectarea = $request->area;
            $start = $request->dateFrom;
            $end = $request->dateTo;
                return view('barchart2',compact('areas','brands','selectarea','start','end'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
