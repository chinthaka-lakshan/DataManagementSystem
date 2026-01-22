<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Households;
use App\Models\Divisions;

class Citizens extends Model
{
    protected $table = 'citizens';

    protected $fillable = [
        'household_id',
        'division_id',
        'full_name',
        'nic',
        'date_of_birth',
        'gender',
        'religion',
        'marital_status',
        'occupation',
        'education_level',
        'income_level',
        'samurdhi_status',
        'special_notes',
    ];

    public function household()
    {
        return $this->belongsTo(Households::class);
    }
    public function division()
    {
        return $this->belongsTo(Divisions::class);
    }
}
