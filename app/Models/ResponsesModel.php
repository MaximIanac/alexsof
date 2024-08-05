<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsesModel extends Model
{
    use HasFactory;

    protected $table = 'responses';

    protected $fillable = [
        'attending',
        'attending_with_partner',
        'first_name',
        'last_name',
        'partner_first_name',
        'partner_last_name',
        'drink_preferences',
    ];
}
