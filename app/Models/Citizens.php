<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizens extends Model
{
    protected $table = 'citizens';

    protected $fillable = [
        'household_id',
        'full_name',
        'nic',
        'date_of_birth',
        'gender',
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
}
