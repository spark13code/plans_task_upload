<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\plan;
use App\Models\ComboPlan;

use Yajra\DataTables\Facades\DataTables;

class ComboPlans extends Controller
{
      //Combo Plans Listing

      public function index(Request $request) {

        return view('combo-plans.list');

    } 

     // Fetch Combo Plans for listing

     public function getPlansCombo(Request $request) {

        $comboPlan = ComboPlan::with('plans')->orderBy('created_at','desc');;
        
        return DataTables::of($comboPlan)
        ->addColumn('plan_name',function($row) {
            return $row->name;
        })
        ->addColumn('plan_price',function($row) {
            return $row->price.' '.env('CURRENCY');
        })
        ->addColumn('plans',function($row) {
            $string = '';

            foreach($row->plans as $plan) {
                $string .= $plan->name.', ';
            }

            return $string;
        })
        ->addColumn('action', function ($row) {
            // Add custom action buttons (optional)
            return '<a href="/add-combo-plan/' . $row->id . '" class="btn btn-primary text-white me-0">Edit</a>
            <a href="/delete-combo-plan/' . $row->id . '" class="btn btn-danger text-white me-0">Delete</a>';
        })
        ->rawColumns(['plan_name','plan_price','plans','action']) // Mark 'action' column as raw HTML
        ->make(true);


    }


     // Add Combo Plan Form view

     public function addComboPlan(Request $request) {

        $data = [];
        $id = $request->id;

        if($id) {

            $data = ComboPlan::with('plans')->find($id);

        }

        return view('combo-plans.add')->with(['data' => $data]);

    }

    // Fetch Plans
    public function getPlans(Request $request){

        $id = $request->id;
        $planId = [];
        if($id){
        
        $comboPlan = ComboPlan::with('plans')->find($id);
        if($comboPlan){
            foreach($comboPlan->plans as $plan) {
            array_push($planId,$plan->id);
        }
        }

        }
        
        $plans = plan::select(['id','name','price','description']);

        return DataTables::of($plans)
        ->addColumn('action', function ($row)  use ($planId){
            // Add custom action buttons (optional)
            $checked = '';
            if(in_array($row->id,$planId)){
                $checked = 'checked';
            }

            return '<input type="checkbox" class="form-check-input" name="plans[]" value="'.$row->id.'" '.$checked.'>';
        })
        ->addColumn('plan_name',function($row) {
            return $row->name;
        })
        ->addColumn('plan_price',function($row) {
            return $row->price.' '.env('CURRENCY');
        })
      
        ->rawColumns(['action','plan_name','plan_price']) // Mark 'action' column as raw HTML
        ->make(true);


    }

    
    // Insert or Update Combo Plans

    public function insertUpdateComboPlan(Request $request) {

        $validatedData = $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'plans' => 'required',
        ]);

        $id = $request->id;

        $message = '';

        
        if($id > 0) {

            $comboPlan = ComboPlan::find($id);
            
            $message = 'Combo Plan Updated successfully!';
        } else {

            $comboPlan = new ComboPlan();
            $message = 'Plan Inserted successfully!';

        }

        $comboPlan->name = $request->plan_name;
        $comboPlan->price = $request->plan_price;
        $comboPlan->save();

        $planIds = plan::whereIn('id', $request->plans)->pluck('id')->toArray();
        $comboPlan->plans()->detach();
        // Attach the plans to the ComboPlan
        $comboPlan->plans()->attach($planIds);

        return response()->json(['message' => $message]);


    }


    // Delete Combo Plan 

    public function deleteComboPlan(Request $request) {

        
        $id = $request->id;

        if( $id > 0 ) {

            $comboPlan = ComboPlan::find($id);
            $comboPlan->delete();

        } else {

            alert('Combo Plan not found!');

        }

        return redirect()->route('combo-plans.list'); 

    }



}
