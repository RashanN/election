<?php

namespace App\Http\Controllers;
use App\Models\NationalVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        
        $results = DB::table('_national_votes') 
            ->select('party_id', DB::raw('COUNT(*) as count'))
            ->where('priority', 1)
            ->groupBy('party_id')
            ->orderBy('count', 'desc')
            ->limit(3)
            ->get();
    
       
        $partyIds = $results->pluck('party_id');
    
      
        $parties = DB::table('parties')->whereIn('id', $partyIds)->get()->keyBy('id');
    
     
        $data = $results->map(function ($result) use ($parties) {
            return [
                'party_name' => $parties[$result->party_id]->candidate_name,
                'count' => $result->count,
            ];
        });
        return view('dashboard', compact('data'));
    }
        public function getNationalVotes()
    {
        
        $votes = NationalVote::with(['user', 'party'])
            ->select('priority', 'party_id', 'user_id')
            ->get();

       
        return view('admin.dashboard', compact('votes'));
    }
}
