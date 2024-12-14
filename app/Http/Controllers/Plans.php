<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\plan;

use Yajra\DataTables\Facades\DataTables;

class Plans extends Controller
{
    // Plans Listing

    public function index(Request $request) {

        return view('plans.list');

    } 


    // Add Plan Form view

    public function addPlan(Request $request) {

        $data = [];
        $id = $request->id;

        if($id) {

            $data = plan::find($id);

        }

        return view('plans.add')->with(['data' => $data]);

    }


    // Fetch Plans for listing

    public function getPlans(Request $request) {

        $plans = plan::select(['id','name','price','description'])->orderBy('created_at','desc');

        return DataTables::of($plans)
        ->addColumn('plan_name',function($row) {
            return $row->name;
        })
        ->addColumn('plan_price',function($row) {
            return $row->price.' '.env('CURRENCY');
        })
        ->addColumn('plan_description',function($row) {
            return $row->description;
        })
        ->addColumn('action', function ($row) {
            // Add custom action buttons (optional)
            return '<a href="/add-plan/' . $row->id . '" class="btn btn-primary text-white me-0">Edit</a>
            <a href="/delete-plan/' . $row->id . '" class="btn btn-danger text-white me-0">Delete</a>';
        })
        ->rawColumns(['plan_name','plan_price','plan_description','action']) // Mark 'action' column as raw HTML
        ->make(true);


    }


    // Insert or Update Plans

    public function insertUpdatePlan(Request $request) {

        $validatedData = $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'plan_description' => 'required',
        ]);

        $id = $request->id;

        $message = '';

        if($id > 0) {
            $plan = plan::find($id);
            $message = 'Plan Updated successfully!';
        } else {

            $plan = new plan();
            $message = 'Plan Inserted successfully!';

        }

        $plan->name = $request->plan_name;
        $plan->price = $request->plan_price;
        $plan->description = $request->plan_description;
        $plan->save();

        return response()->json(['message' => $message]);


    }


    // Delete Plan
    public function deletePlan(Request $request) {

        $id = $request->id;

        if( $id > 0 ) {

            $plan = plan::find($id);
            $plan->delete();

        } else {

            alert('Plan not found!');

        }

        return redirect()->route('plans.list'); 

    }

}
