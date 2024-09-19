<?php

namespace App\Http\Controllers;
use App\Models\Party;
use App\Models\District;
use App\Models\DistrictVote;
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
    public function getNationalVotes(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
        }
        $votesCount = NationalVote::all()->count();
        
        $query = NationalVote::with(['user', 'party'])
                             ->select('priority', 'party_id', 'user_id');
    
        
        if ($request->filled('candidate')) {
            $query->where('party_id', $request->input('candidate'));
        }
    
        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }
    
   
        $votes = $query->paginate(25); 
    
        
        $usercount = $votesCount / 3;
    
       
        $candidates = Party::all();
      

        $districtVotesCount = DistrictVote::all()->count();

        // Start building the query for district votes
        $queryDistrict = DistrictVote::with(['user', 'party', 'district'])
        ->select('priority', 'party_id', 'user_id', 'district_id');

            // Apply filters
            if ($request->filled('district')) {
            $queryDistrict->where('district_id', $request->input('district'));
            }

            if ($request->filled('priority')) {
            $queryDistrict->where('priority', $request->input('priority'));
            }

            if ($request->filled('candidate')) {
            $queryDistrict->where('party_id', $request->input('candidate'));
            }

            // Paginate results
            $districtVotes = $queryDistrict->paginate(25);

        $districtCount= $districtVotesCount/3;
        $districts = District::all();
        
        return view('admin.dashboard', compact('votes', 'usercount', 'candidates', 'districts', 'districtCount', 'districtVotes'));
    }
}
