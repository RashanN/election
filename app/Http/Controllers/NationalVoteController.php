<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\NationalVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NationalVoteController extends Controller
{
    //
    public function create(){
        $parties = Party::all();
    
        // Pass parties to the view
        return view('nationalvote', compact('parties'));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        
        
        $request->validate([
            'first_prediction' => 'required|exists:parties,id',
            'second_prediction' => 'required|exists:parties,id',
            'third_prediction' => 'required|exists:parties,id',
        ]);
        NationalVote::create([
            'priority' => 1,
            'party_id' => $request->input('first_prediction'),
            'user_id' => $user_id,
        ]);
        NationalVote::create([
            'priority' => 2,
            'party_id' => $request->input('second_prediction'),
            'user_id' => $user_id,
        ]);
        NationalVote::create([
            'priority' => 3,
            'party_id' => $request->input('third_prediction'),
            'user_id' => $user_id,
        ]);
        if ($user->email !== 'guest@example.com') {
           
            $user->isNVdone = true;
            $user->save();
        }
        return redirect()->route('nationalresults')->with('success', 'Predictions submitted successfully.');

    }
    public function showResults()
    {
        $results = DB::table('national_vote_summary')
         ->whereIn('ranking', [1, 2, 3])
         ->get();

       
        $data = [];
        foreach($results as $result ){
            $count = 0;
            switch ($result->ranking) {
                case 1:
                    $count = $result->priority_1_percentage;
                        break;
                case 2:
                     $count = $result->priority_2_percentage;
                        break;
                case 3:
                     $count = $result->priority_3_percentage;
                         break;
             }
                        
                     $data[] = [
                        "party_name" => $result->candidate_name,
                        "count" => $count
                         ];
        }
      
      
        return view('nationalresult', ['data' => collect($data)]);
    }
}
