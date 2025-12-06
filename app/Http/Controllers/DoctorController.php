<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function registerIndex() {
        return view('dokter.pendaftaran.index');
    }
    public function register(Request $request){
        $request->validate([        
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'gender' => 'required|string|max:255|in:male,female',
            'str' => 'required|string|max:255',
            'sip' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        $document = $request->file('document');
        $document_name = now()->format('YmdHis') . '_' . $document->getClientOriginalName();
        $document->move(public_path('documents/applicants'), $document_name);
        
        Application::create([
            'user_id' => auth()->user()->id,
            'full_name' => $request->input('full_name'),
            'nik' => $request->input('nik'),
            'gender' => $request->input('gender'),
            'str' => $request->input('str'),
            'sip' => $request->input('sip'),
            'spesialisasi' => $request->input('spesialisasi'),
            'document' => $document_name,
        ]);

        return redirect()->route('home')->with('success', 'Application submitted successfully!');
    }
}
