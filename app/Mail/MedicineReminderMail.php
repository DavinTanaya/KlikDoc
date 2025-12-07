<?php

namespace App\Mail;

use App\Models\MedicineSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MedicineReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public MedicineSchedule $schedule;

    /**
     * Create a new message instance.
     */
    public function __construct(MedicineSchedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $reminder = $this->schedule->reminder;
        $user     = $reminder->user;

        $subject = 'Pengingat Obat: ' . $reminder->medicine_name . ' (' . $this->schedule->schedule_time . ')';

        return $this->subject($subject)
            ->view('emails.medicine_reminder')
            ->with([
                'user'     => $user,
                'reminder' => $reminder,
                'schedule' => $this->schedule,
            ]);
    }
}
