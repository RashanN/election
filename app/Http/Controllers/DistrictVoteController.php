<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\District;
use App\Models\DistrictVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DistrictVoteController extends Controller
{
    //
    public function create(){
        $parties = Party::all();
        $districts = District::all();
        return view('districtvote', compact('parties','districts'));
    }
    public function store(Request $request){
        $user_id = Auth::id();

    
    $request->validate([
        'district' => 'required|exists:districts,id', 
        'first_prediction' => 'required|exists:parties,id',
        'second_prediction' => 'required|exists:parties,id',
        'third_prediction' => 'required|exists:parties,id',
    ]);

    
    DistrictVote::create([
        'priority' => 1,
        'party_id' => $request->input('first_prediction'),
        'user_id' => $user_id,
        'district_id' => $request->input('district'),
    ]);

    DistrictVote::create([
        'priority' => 2,
        'party_id' => $request->input('second_prediction'),
        'user_id' => $user_id,
        'district_id' => $request->input('district'),
    ]);

    DistrictVote::create([
        'priority' => 3,
        'party_id' => $request->input('third_prediction'),
        'user_id' => $user_id,
        'district_id' => $request->input('district'),
    ]);

        
        return redirect()->route('nationalresults')->with('success', 'Predictions submitted successfully.');
    }
}
