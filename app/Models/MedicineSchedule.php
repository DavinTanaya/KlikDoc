<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineSchedule extends Model
{
    protected $fillable = [
        'medicine_reminder_id',
        'schedule_date',
        'schedule_time',
        'is_sent',
        'sent_at',
    ];

    public function reminder()
    {
        return $this->belongsTo(MedicineReminder::class, 'medicine_reminder_id');
    }
}

