<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Cabinet;
use App\Models\product;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CabinetController extends Controller
{

 
    public function index(Request $request)
    {
        // return $request;
        $Cabinet = Cabinet::when($request->search, function ($q) use ($request) {

            return $q->where('description','like', '%' . $request->search . '%');

        })->latest()->paginate(5);

        $sales_data = Cabinet::select(
            
            DB::raw('SUM(Cabinet) as sum')
            
        )->get();
        $departed_data = Cabinet::select(
            
            DB::raw('SUM(departed) as sum')
            
        )->get();

        $Stored_capital = product::select(
            
            DB::raw('SUM(Stored_capital) as sum')
            
        )->get();

        $products_capital = product::select(
            
            DB::raw('SUM(capital) as sum')
           
            
        )->get();
      
        $orders = order::select(
            
            DB::raw('SUM(total_discuont) as sum')
            
        )->get();
        $int = intval(preg_replace('/[^0-9]+/', '', $sales_data), 10);
        $data = intval(preg_replace('/[^0-9]+/', '', $departed_data), 10);
        $products_capital = intval(preg_replace('/[^0-9]+/', '', $products_capital), 10);
        $Stored_capital = intval(preg_replace('/[^0-9]+/', '', $Stored_capital), 10);
        $discuont = intval(preg_replace('/[^0-9]+/', '', $orders), 10);
        return view('admin.Cabinet.index', compact('Cabinet' ,'int','data','orders','Stored_capital','discuont', 'products_capital'));

    }//end of index

   
    public function create()
    {
        return view('admin.Cabinet.create');
    }

    public function show(Request $request)
    {
        return view('admin.Cabinet.create');
    }

    public function store(Request $request)
    {
        // return $request;
         $validatedData = $request->validate([
            'Cabinet' => 'required',
            'departed' => 'required',
            'description' => 'required',
        ]);

        Cabinet::create([
                'Cabinet' => $request->Cabinet,
                'description' => $request->description,
                'Created_by' => (Auth::user()->first_name),
                'departed' => $request->departed,
            ]);
          session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.Cabinet.index');
       
    }

   

    public function edit( Cabinet $Cabinet)
    {
        return view('admin.Cabinet.edit', compact('Cabinet'));
    }

   
    public function update(Request $request, Cabinet $Cabinet)

    {
       
        $id = $request->id;

        $this->validate($request, [

            'Cabinet' => 'required',
            'description' => 'required',
        ]);
        $Cabinet->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.Cabinet.index');
  }

    public function destroy( Cabinet $Cabinet)
    {
        $Cabinet->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.Cabinet.index');
    }
}
