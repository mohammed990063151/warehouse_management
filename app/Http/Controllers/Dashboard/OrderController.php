<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        
        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%');

        })->paginate(5);
        // return $orders;
        return view('admin.orders.index', compact('orders'));
        

    }//end of index

    public function products(Order $order)
    {
        $products = $order->products;
        return view('admin.orders._products', compact('order', 'products'));

    }//end of products
    
    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity,
                'Stored_capital' => ($product->stock + $product->pivot->quantity) * $product->purchase_price
            ]);

        }//end of for each

        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    
    }//end of order

}//end of controller

