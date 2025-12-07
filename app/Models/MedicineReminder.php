<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineReminder extends Model
{
    protected $fillable = [
        'user_id',
        'medicine_name',
        'frequency',
        'start_time',
        'note',
        'is_active',
    ];

    public function schedules()
    {
        return $this->hasMany(MedicineSchedule::class, 'medicine_reminder_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
