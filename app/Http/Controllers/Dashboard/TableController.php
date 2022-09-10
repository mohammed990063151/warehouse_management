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
class TableController extends Controller
{

 
    public function index(Request $request)
    {
       
        return view('admin.calendar.calendar');

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
