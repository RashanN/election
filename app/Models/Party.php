<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'abbreviation', 'logo', 'candidate_name'];

    public function nationalVotes()
    {
        return $this->hasMany(NationalVote::class);
    }
    public function districtVotes()
    {
        return $this->hasMany(DistrictVote::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    
}
