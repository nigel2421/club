<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'member_number',
        'contact_details',
        'status',
        'member_type',
        'date_of_birth',
        'gender',
        'phone_number',
        'doj',
        'profession',
        'race',
        'minimum_spent',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
