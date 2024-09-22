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
        $results = DB::table('national_vote_summary')
        ->orderByDesc('priority_1_count')
         ->take(4) 
         ->get();
       
        $data = [];
        foreach($results as $result ){
            $count = 0;
           
                    $count = $result->priority_1_percentage;
                      
                        
                     $data[] = [
                        "party_name" => $result->candidate_name,
                        "count" => $count
                         ];
        }
      
            
       
        $district_id = Auth::user()->extra_column;
        $district = District::find($district_id);

    
     
        $results = DB::table('result_national')
        ->join('parties', 'result_national.party_id', '=', 'parties.id') // Joining result_national with parties table
        ->select('result_national.id', 'result_national.result', 'result_national.priority', 'result_national.created_at', 'result_national.updated_at', 'parties.candidate_name') // Selecting necessary fields
        ->orderBy('result_national.priority', 'desc') // Order by priority descending
        ->take(3) // Get the first 3 values
        ->get();

       
        $data1 = [];
        foreach($results as $result ){
            $count = 0;
            
                    $count = $result->priority_1_percentage;
                      
               
          
                        
                     $data1[] = [
                        "party_name" => $result->candidate_name,
                        "count" => $count
                         ];
        

    }
   
      
    return view('dashboard', compact( 'district') + ['data' => collect($data), 'data1' => collect($data1),'district_name' => $result->district_name]);
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
