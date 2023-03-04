<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ItemDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    //
	
	public function index() { 
	 $order = Order::get();
	 return view('order.index',compact('order'));
   }
   
   public function json($id) { 
	 //$order = Order::where('id',$id)->get();
	 $order = Order::get();
	 $orderdata=array();
	 $sno=0;
	 foreach($order as $row)
	 {	
	 
		 $orderdata['data'][$sno]['order_no']=$row->order_no;
		 $orderdata['data'][$sno]['order_date']=$row->order_date;
		 $orderdata['data'][$sno]['customer_no']=$row->customer_no;
		 $orderdata['data'][$sno]['customer_name']=$row->customer_name;
		 $orderdata['data'][$sno]['items']=$row->items;
		 $sno++;
	 }
	 
	 if(count($orderdata)>0){ echo json_encode($orderdata); }else{ }
   }
   
   public function create() 
   { 
	$str_random=Str::random(12);
	return view('order.create',compact('str_random'));
   }
   
   public function store(Request $request) 
   { 
	 $data = $request->except('_method','_token','submit');
        
        $validator = Validator::make($request->all(), [
           'order_no' => 'required',
           'order_date' => 'required',
		   'customer_no' => 'required',
		   'customer_name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }
		try {
		DB::beginTransaction();
        $order=new Order();
		$order->order_no=$request->order_no;
		$order->order_date=$request->order_date;
		$order->customer_no=$request->customer_no;
		$order->customer_name=$request->customer_name;
		$order->save();
		$order_id=$order->id;
        $input_data = $request->input('order');
		 
		 foreach ($input_data as $data) {
				$item = new ItemDetail();
                $item->order_id = $order_id;
                $item->item = $data['item'];
				$item->uom = $data['uom'];
				$item->quantitty = $data['qty'];
				$item->price = $data['price'];
				$item->discount = $data['discount'];
				$item->value = $data['value'];
				$item->save();
		 }
       DB::commit();
	   
	   return Back()->with('success', 'saved done.');
	    } catch (\Exception $e) {
            DB::rollBack();
            return Back()->with('error', 'Error.');
        }
         
   }
   public function view($id) 
   { 
	 $order = Order::find($id);
        
        return view('order.view')->with('order',$order);
   }
   
   public function edit($id) 
   { 
	 $order = Order::find($id);
        
        return view('order.edit')->with('order',$order);
   }
   
   public function update($id,Request $request) 
   { 
	 $data = $request->except('_method','_token','submit');
        
        $validator = Validator::make($request->all(), [
           'order_no' => 'required',
           'order_date' => 'required',
		   'customer_no' => 'required',
		   'customer_name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }
		try {
		DB::beginTransaction();
        $order=Order::find($id);
		$order->order_no=$request->order_no;
		$order->order_date=$request->order_date;
		$order->customer_no=$request->customer_no;
		$order->customer_name=$request->customer_name;
		$order->save();
		$order_id=$order->id;
        $input_data = $request->input('order');
		 
		 ItemDetail::where('order_id',$order_id)->delete();
		 
		 foreach ($input_data as $data) {
				$item = new ItemDetail();
                $item->order_id = $order_id;
                $item->item = $data['item'];
				$item->uom = $data['uom'];
				$item->quantitty = $data['qty'];
				$item->price = $data['price'];
				$item->discount = $data['discount'];
				$item->value = $data['value'];
				$item->save();
		 }
       DB::commit();
	   return Back()->with('success', 'Update done.');
	    } catch (\Exception $e) {
            
            return Back()->with('error', 'Error.');
        }
        
   }
   
   public function destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete(); // Easy right?
 
        return redirect('/stocks')->with('success', 'Stock removed.');  // -> resources/views/stocks/index.blade.php
    } 
}
