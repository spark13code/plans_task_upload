<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EligibleCriteria;

use Yajra\DataTables\Facades\DataTables;

class EligibilityCriteria extends Controller
{
    // Eligibility Criteria  Listing

    public function index(Request $request) {

        return view('eligibility-criteria.list');

    } 


    // Fetch Eligible Criteria

    public function getEligibleCriteria(Request $request){

        $criteria = EligibleCriteria::select(['id','name','age_less_than','age_greater_than','last_login_days_ago','income_less_than','income_greater_than'])->orderBy('created_at','desc');;

        return DataTables::of($criteria)
        ->addColumn('name',function($row) {
            return $row->name;
        })
        ->addColumn('age_less_than',function($row) {
            return $row->age_less_than;
        })
        ->addColumn('age_greater_than',function($row) {
            return $row->age_greater_than;
        })
        ->addColumn('last_login_days_ago',function($row) {
            return $row->last_login_days_ago;
        })
        ->addColumn('income_less_than',function($row) {
            return $row->income_less_than;
        })
        ->addColumn('income_greater_than',function($row) {
            return $row->income_greater_than;
        })
        ->addColumn('action', function ($row) {
            // Add custom action buttons (optional)
            return '<a href="/add-eligible-criteria/' . $row->id . '" class="btn btn-primary text-white me-0">Edit</a>
            <a href="/delete-eligible-criteria/' . $row->id . '" class="btn btn-danger text-white me-0">Delete</a>';
        })
        ->rawColumns(['name','age_less_than','age_greater_than','last_login_days_ago','income_less_than','income_greater_than','action']) // Mark 'action' column as raw HTML
        ->make(true);

    }

     // Add Eligible Criteria

     public function addEligibleCriteria(Request $request) {

        $data = [];
        $id = $request->id;

        if($id) {

            $data = EligibleCriteria::find($id);

        }

        return view('eligibility-criteria.add')->with(['data' => $data]);

    }


    // Insert or Update Eligible Criteria
    public function insertUpdateEligibleCriteria(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'age_less_than' => 'required',
            'age_greater_than' => 'required',
            'last_login_days_ago' => 'required',
            'income_less_than' => 'required',
            'income_greater_than' => 'required',
        ]);

        $id = $request->id;

        $message = '';

        if($id > 0) {
            $EligibleCriteria = EligibleCriteria::find($id);
            $message = 'Eligible Criteria Updated successfully!';
        } else {

            $EligibleCriteria = new EligibleCriteria();
            $message = 'Eligible Criteria Inserted successfully!';

        }

        $EligibleCriteria->name = $request->name;
        $EligibleCriteria->age_less_than = $request->age_less_than;
        $EligibleCriteria->age_greater_than = $request->age_greater_than;
        $EligibleCriteria->last_login_days_ago = $request->last_login_days_ago;
        $EligibleCriteria->income_less_than = $request->income_less_than;
        $EligibleCriteria->income_greater_than = $request->income_greater_than;

        $EligibleCriteria->save();

        return response()->json(['message' => $message]);

    }


     // Delete Plan
     public function deleteEligibleCriteria(Request $request) {

        $id = $request->id;

        if( $id > 0 ) {

            $EligibleCriteria = EligibleCriteria::find($id);
            $EligibleCriteria->delete();

        } else {

            alert('Eligible Criteria not found!');

        }

        return redirect()->route('eligibility-criteria.list'); 

    }


}


