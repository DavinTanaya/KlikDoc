<?php

namespace App\Http\Controllers;

use App\Models\MedicineReminder;
use App\Models\MedicineSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MedicineReminderController extends Controller
{
    public function index()
    {
        $reminders = MedicineReminder::where('user_id', auth()->id())
            ->where('is_active', true)
            ->with('schedules')
            ->get();

        return view('user.mandiri.pages.obat', compact('reminders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'frequency' => 'required|integer|min:1|max:4',
            'time'      => 'required',
            'note'      => 'nullable|string',
        ]);

        /** 1️⃣ Simpan reminder utama */
        $reminder = MedicineReminder::create([
            'user_id'        => auth()->id(),
            'medicine_name'  => $request->name,
            'frequency'      => $request->frequency,
            'start_time'     => $request->time,
            'note'           => $request->note,
            'is_active'      => true,
        ]);

        /** 2️⃣ Generate jadwal untuk HARI INI */
        $this->generateSchedules($reminder);

        /** 3️⃣ Return HTML */
        $html = view('components.medicine-reminder-item', compact('reminder'))->render();

        return response()->json(['html' => $html]);
    }

    public function destroy($id)
    {
        $reminder = MedicineReminder::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $reminder->update(['is_active' => false]);

        return response()->json(['success' => true]);
    }

    /**
     * ===============================
     * Generate Schedule Logic
     * ===============================
     */
    private function generateSchedules(MedicineReminder $reminder)
    {
        $startTime = Carbon::createFromFormat('H:i', $reminder->start_time);
        $intervalHours = floor(24 / $reminder->frequency);

        for ($i = 0; $i < $reminder->frequency; $i++) {
            MedicineSchedule::create([
                'medicine_reminder_id' => $reminder->id,
                'schedule_date' => now()->toDateString(),
                'schedule_time' => $startTime->copy()->addHours($i * $intervalHours)->format('H:i'),
                'is_sent' => false,
            ]);
        }
    }
}
