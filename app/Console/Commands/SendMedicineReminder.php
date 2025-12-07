<?php

namespace App\Console\Commands;

use App\Mail\MedicineReminderMail;
use App\Models\MedicineSchedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMedicineReminder extends Command
{
    protected $signature = 'medicine:send-reminder';
    protected $description = 'Kirim email pengingat obat';

    public function handle()
    {
        $now = now()->format('H:i');

        $schedules = MedicineSchedule::where('schedule_date', now()->toDateString())
            ->where('schedule_time', '<=', $now)
            ->where('is_sent', false)
            ->with('reminder.user')
            ->get();

        foreach ($schedules as $schedule) {
            Mail::to($schedule->reminder->user->email)
                ->queue(new MedicineReminderMail($schedule));

            $schedule->update(attributes: [
                'is_sent' => true,
                'sent_at' => now(),
            ]);
        }
    }
}
