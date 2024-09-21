<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\District;
use App\Models\DistrictVote;
use App\Models\NationalVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DistrictVoteController extends Controller
{
    //
    public function create(Request $request){
      
        $districtId = $request->query('district');

        $parties = Party::all();
        $districts = District::all();

        $district = District::find($districtId);

       
        return view('districtvote', compact('parties','districts','districtId','district'));
    }


    public function store(Request $request){
        $user_id = Auth::id();
        $user = Auth::user();
    
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
    if ($user->email == 'guest@example.com'){
        $user->extra_column = $request->input('district');
        $user->save();
    }
    if ($user->email !== 'guest@example.com') {
           
        $user->isDVdone = true;
        $user->extra_column = $request->input('district');
        $user->save();
    }
   
        
     return redirect()->route('districtresults')->with('success', 'Predictions submitted successfully.');
    

    }

    public function showResults(){
        
       
       
        $district_id = Auth::user()->extra_column;
      
    if ($district_id) {
     
        $results = DB::table('district_vote_summary')
         ->where('district_id',$district_id)
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

        
        return view('districtresult', ['data' => collect($data),'district_name' => $result->district_name ]);
    } else {
       
        return view('districtresult', ['data' => [],'district_name' => '']);
    }
    }
    public function showImage(){
        $districts = District::all();
        return view('districtimage', compact('districts'));
    }

    public function result(){

        $user_id= Auth::user()->id;
        $districtId=Auth::user()->extra_column;
        
        $lastNationalVotes = NationalVote::where('user_id', $user_id)
        ->latest()            // Sort by the latest created_at
        ->take(3)  
        ->Orderby('priority')            // Limit to the last 3 results
        ->with('party')       // Eager load the associated party
        ->get();

        $lastDistrictVotes = DistrictVote::where('user_id', $user_id)
        ->latest()               // Sort by the latest created_at
        ->take(3)                // Limit to the last 3 results
        ->orderBy('priority')    // Order by priority
        ->with('party') // Eager load both party and district
        ->get();
        
        $district = District::find($districtId);

        // Check if the district exists, if not use 'Colombo'
        $districtName = $district ? $district->name : 'Colombo';
    
    

    return view('result', compact('lastNationalVotes','lastDistrictVotes','districtName'));



    }
}
