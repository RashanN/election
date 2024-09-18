<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictVote extends Model
{
    use HasFactory;
    protected $fillable = ['priority', 'party_id', 'user_id', 'district_id'];
    protected $table = '_district_votes';
  
    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
