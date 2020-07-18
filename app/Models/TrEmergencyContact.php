<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrEmergencyContact extends Model
{
    //

    protected $table = 'e_recruit.tr_emergency_contact';
    protected $primaryKey = 'emergency_contact_id';
    public $timestamps = false;
}
