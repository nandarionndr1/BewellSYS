<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\Controller;
use App\Supplier;
use App\SupplierOrder;
use App\SupplierOrderDetail;
use App\Supply;
use DateTime;

class SupplierReportDetailController extends Controller
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

        $orderdetails = SupplierOrderDetail::all();
        return view('appdev.supplierreportdetail')->with("orderdetails",$orderdetails);
    }

    public function getSupplierOrder($id){

        $order = SupplierOrder::find($id);
        if($order['id'] == null) {
            return view('errors.404');
        }

        $date = date_create($order['spod_date']);
        $order['spod_date'] = date_format($date, "F j Y");

        $orderdetails = DB::table('bc_supplier_order_detail')->join('bc_supplier_order','bc_supplier_order_detail.orderID','=','bc_supplier_order.id')->where('orderID',$order['id'])->get()->toArray();
        return view("appdev.supplierreportdetail",['order' => $order])->with("orderdetails",$orderdetails);
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
