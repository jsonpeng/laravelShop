<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecItem extends Model
{

    public $table = 'spec_items';
    

    public $fillable = [
        'name',
        'spec_id'
    ];

}
