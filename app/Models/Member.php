<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'phone_number',
        'doj',
        'profession',
        'race',
        'gender',
        'minimum_spent',
    ];

    protected $appends = ['age'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }
}
