<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Currency;
use App\Office;
use App\Employee;

class OrderController extends Controller
{
    public function showOrderForm() {
        if(!Auth::user()->isAdmin()) {
            $offices = Office::all();
            $currencies = Currency::all();
            return view('add_order', ['offices' => $offices,'currencies' => $currencies]);
        }
        else {
            return redirect('/home');
        }
    }

    public function exterminate(Request $request){
        $order = Order::where('id',$request->get('order_item'))->first();
        if ($order->status == 'Moderation') {
            $order->delete();
        }


        return redirect('/home');        
        }

    public function manageOrder(Request $request)
    {
        //if(Order::where([['office_id', Employee::where('passport_number', Auth::user()->passport_number)->first()->exchange_office_id],['id',(int)$request->all()]])->exists())
        {
            if($request->get('reject') != null)
            {      
                $order = Order::where('id',$request->get('reject'))->first();
                $order->status = 'Declined';
                $order->save();
            }
            else if($request->get('enqueue') != null)
            {
                $order = Order::where('id',$request->get('enqueue'))->first();
                $order->status = 'Pending';
                $order->save();
            }
            else
            {

            }
        }
        return redirect('/home');
    }

    public function add(Request $request) {

        $target_currency_code = $request->get('currency_code');
        $office_id = $request->get('exchange_office');
        $target_currency_amount = $request->get('target_currency_amount');

        $order = new Order;

        $order->target_currency_code = $target_currency_code;
        $order->office_id = $office_id;
        $order->target_currency_amount = $target_currency_amount;
        $order->date = date('Y-m-d');
        $order->customer_passport_number =Auth::user()->passport_number;

        $order->save();
        return redirect('/home');
    }
}
