<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Session;
use App\Supply;
use App\SupplyLogs;

use DateTime;


class SupplyDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $date1 = date("Y-m-d");
        $supplylogs = SupplyLogs::all();
        return view('appdev.supplydetail')->with("supplylogs",$supplylogs)->with("date1",$date1);
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

    public function getSupply($id){

        $supply1 = Supply::find($id);
        if($supply1['id'] == null){
            return view('errors.404');
        }
        $supply_logs = DB::table('bc_supply_logs')->join('bc_supply','bc_supply_logs.materialID','=','bc_supply.id')->where('materialID',$supply1['id'])->get()->toArray();
        return view("appdev.supplydetail",['supply1' => $supply1])->with("supply_logs",$supply_logs);
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
