<?php

namespace App\Modules\UserPreference\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPreference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'typeable_id',
        'typeable_type',
    ];

    // Add any additional methods or relationships here
}
