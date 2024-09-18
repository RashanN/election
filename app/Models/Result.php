<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = ['priority', 'district_id', 'party_id'];

    // Define relationship with District
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Define relationship with Party
    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
