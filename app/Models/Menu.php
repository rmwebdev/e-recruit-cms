<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //

    protected $table = 'e_recruit.menu';
    protected $primaryKey = 'menu_id';
    public $timestamps = true;
    public $guarded = [];

}
