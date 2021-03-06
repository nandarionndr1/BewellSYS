<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manufacturer;
use App\Supply;
use App\ManufacturerOrder;
use App\ManufacturerOrderDetail;
use DateTime;

class ManufacturerAddOrderLiveUpdateController extends Controller
{
    public function liveUpdate(Request $request)
    {   
        $json_orders = [];
        $date = new DateTime();
        $manufacturer = Manufacturer::where('mn_name','=',$request->manufacturerInfo[0][0])->first();
        $orderList = $request->orderList;

        $new_order = new ManufacturerOrder();
        $new_order->manufacturerID= $manufacturer->id;
        $new_order->mnod_date = date("Y/m/d");
        $new_order->mnod_status = 'Processing';
        $new_order->mnod_completed = null;
        $new_order->mnod_payment =$request->manufacturerInfo[0][2] ;
        $new_order->mnod_expected  = $request->manufacturerInfo[0][1];
        $new_order->created_at = $date->getTimestamp();
        $new_order->updated_at = $date->getTimestamp();
        $new_order->save();

        $count = 0;
        foreach($orderList as $order){
            $new_order_detail = new ManufacturerOrderDetail();
            $new_order_detail->orderID = $new_order->id;

            $material = Supply::where('sp_name','=',$order[0])
                        ->where('sp_sku','=',$order[1])
                        ->first();

            $new_order_detail->supplyID = $material->id;
            $new_order_detail->mndt_qty = $order[2];

            $new_order_detail->created_at = $date->getTimestamp();
            $new_order_detail->updated_at = $date->getTimestamp();
            $new_order_detail->save();

            $count = $count + 1;
        }        

        return response()->json([
            'order'=>$new_order,
            'manufacturer'=>$manufacturer->mn_name,
        ]);
    }
}
