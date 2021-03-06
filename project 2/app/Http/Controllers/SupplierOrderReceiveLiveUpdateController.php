<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupplierOrderDetail;
use App\Supply;

class SupplierOrderReceiveLiveUpdateController extends Controller
{
    public function liveUpdate(Request $request)
    {   
        $count = 0;
        $supplierOrder=[];
        foreach($request->orders as $order){
            $orderDetail = SupplierOrderDetail::where('id','=',$order[0])->first();
            $supply = Supply::where('sp_name','=',$order[1])->where('sp_sku','=',$order[2])->first();
            if($orderDetail->spdt_qty-$orderDetail->received >= $order[3]){
                $orderDetail->received =  $orderDetail->received + $order[3];
                $push = array(
                    $orderDetail->spdt_qty-$orderDetail->received,$orderDetail->received,$orderDetail->id
                );
                array_push($supplierOrder,$push);
                $supply->sp_qty = $supply->sp_qty + $order[3];
                $supply->save();
            }
            $orderDetail->save();
            $count = $count + 1;
        }
        return response()->json([
            'count'=>$count,
            'supplierOrder'=>$supplierOrder,
        ]);
    }
}
