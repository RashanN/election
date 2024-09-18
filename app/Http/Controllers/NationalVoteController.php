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
        return redirect()->back()->with('success', 'Predictions saved successfully!');


    }
    public function showResults()
    {
        $results = DB::table('_national_votes')
        ->select('party_id', DB::raw('COUNT(*) as count'))
        ->where('priority', 1)
        ->groupBy('party_id')
        ->orderBy('count', 'desc')
        ->limit(3) // Get top 3 results
        ->get();

       
       
        $partyIds = $results->pluck('party_id');
        $parties = DB::table('parties')->whereIn('id', $partyIds)->get()->keyBy('id');

        // Combine results with party names
        $data = $results->map(function ($result) use ($parties) {
            return [
                'party_name' => $parties[$result->party_id]->name,
                'count' => $result->count,
            ];
        });

        return view('nationalresult', compact('data'));
    }
}
