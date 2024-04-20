<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;

use Livewire\Component;
use Illuminate\Http\Request;

class AdminOrdersReportsComponent extends Component
{
    public function render()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate();
        return view('livewire.admin.admin-orders-reports-component', ['orders' => $orders]);
    }

    public function Search_orders(Request $request){

        $rdio = $request->rdio;


    // في حالة البحث بنوع الفاتورة

        if ($rdio == 1) {


    // في حالة عدم تحديد تاريخ
            if ($request->country && $request->start_at =='' && $request->end_at =='') {

                $orders = Order::select('*')->where('Country','=',$request->country)->get();
                $country = $request->country;
                return view('livewire.admin.admin-orders-reports-component',compact('country'))->withDetails($orders);
            }

            // في حالة تحديد تاريخ استحقاق
            else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $country = $request->country;

                $orders = Order::whereBetween('created_at',[$start_at,$end_at])->where('Country','=',$request->country)->get();
                return view('livewire.admin.admin-orders-reports-component',compact('country','start_at','end_at'))->withDetails($orders);

            }



        }

    //====================================================================

    // في البحث برقم الفاتورة
        else {

            $orders= Order::select('*')->where('firstname','=',$request->firstname)->get();
            return view('livewire.admin.admin-orders-reports-component')->withDetails($orders);

        }



        }
}
