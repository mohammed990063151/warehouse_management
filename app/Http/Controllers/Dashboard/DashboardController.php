<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Cabinet;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $categories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();

        $sales_data = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();

        
        $Cabinet = Cabinet::select(

            DB::raw('SUM(Cabinet) as sum')

        )->get();
        $departed = Cabinet::select(

            DB::raw('SUM(departed) as sum')

        )->get();
        $orders = Order::select(

            DB::raw('SUM(total_discuont) as sum')

        )->get();
        $discuont = intval(preg_replace('/[^0-9]+/', '', $orders), 10);
        $Cabinet = intval(preg_replace('/[^0-9]+/', '', $Cabinet), 10);
        $departed = intval(preg_replace('/[^0-9]+/', '', $departed), 10);

        return view('admin.dashboard.index', compact('categories_count', 'products_count', 'clients_count', 'users_count', 'sales_data','Cabinet','departed','discuont'));
    
    }//end of index
    
}//end of controller
  
