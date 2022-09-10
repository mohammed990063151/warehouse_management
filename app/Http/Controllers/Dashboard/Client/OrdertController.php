<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdertController extends Controller
{
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        $Product = Product::all();
        return view('admin.clients.orders.create', compact( 'client', 'categories', 'orders','Product'));

    }//end of create

    public function store(Request $request, Client $client)
    {
        
        // dd($request->all());
        $request->validate([
            'products' => 'required|array',
        ]);
      

        $this->attach_order($request, $client);
        // dd($request);
       
        // return $client;
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

    }//end of store

    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('admin.clients.orders.edit', compact('client', 'order', 'categories', 'orders'));

    }//end of edit

    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);

        $this->attach_order($request, $client);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');

    }//end of update

    private function attach_order($request, $client)
    {
        
        

        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);
        // $order->price_order()->attach($request->price_order);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];
            $price  =  $product->sale_price;
            $product->update([
                'stock' => $product->stock - $quantity['quantity'],
                'Stored_capital' => ($product->stock - $quantity['quantity']) * $product->purchase_price
            ]);

        }//end of foreach
        // $discuont = $request->discuont;
            
        $total_discuont = $total_price - $request->discuont ;
      
        $order->update([
            'total_price' => $total_price,
            'price' => $price,
            'total_discuont'=>$total_discuont,
            'discuont'=> $request->discuont
        ]);

    }//end of attach order

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

         $product->update([
                'stock' => $product->stock + $product->pivot->quantity,
                'Stored_capital' => ($product->stock + $product->pivot->quantity) * $product->purchase_price
            ]);

        }//end of for each

        $order->delete();

    }//end of detach order

}//end of controller
