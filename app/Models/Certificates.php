<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    protected $table = 'certificates';

    protected $fillable = [
        'citizen_id',
        'certificate_type',
        'reference_number',
        'issued_date',
        'purpose',
    ];
}
