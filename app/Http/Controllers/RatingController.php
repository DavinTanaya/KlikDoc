<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, $consultationId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $consultation = Consultation::where('id', $consultationId)
            ->where('user_id', auth()->id())
            ->where('status', 'SELESAI')
            ->firstOrFail();

        if ($consultation->rating) {
            return back()->with('error', 'Ulasan sudah diberikan.');
        }

        Rating::create([
            'consultation_id' => $consultation->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim.');
    }
}
