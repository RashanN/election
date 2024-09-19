<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
}
