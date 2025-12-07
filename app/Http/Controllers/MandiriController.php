<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MandiriController extends Controller
{
    public function bmi(){
        return view('user.mandiri.pages.bmi');
    }

    public function calculateBmi(Request $request){
        $request->validate([
            'gender' => 'required',
            'height' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1'
        ]);

        $gender = $request->gender;
        $height = $request->height;
        $weight = $request->weight;

        $heightInMeter = $height / 100;

        $bmi = $weight / ($heightInMeter * $heightInMeter);
        $bmi = round($bmi, 1);

        if ($bmi < 18.5) {
            $status = "Kurus";
            $pesan = "Tetap semangat!";
            $saran = "Anda berada di bawah berat badan ideal. Tingkatkan asupan nutrisi dan konsultasikan dengan ahli gizi.";
            $badge = "status-underweight";
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            $status = "Normal";
            $pesan = "Kerja Bagus!";
            $saran = "Berat badan Anda ideal. Pertahankan pola makan sehat dan rutin berolahraga.";
            $badge = "status-normal";
        } elseif ($bmi >= 25 && $bmi < 30) {
            $status = "Berlebih";
            $pesan = "Kamu pasti bisa!";
            $saran = "Anda berada di kategori overweight. Kurangi makanan tinggi lemak dan rutin olahraga.";
            $badge = "status-warning";
        } else {
            $status = "Obesitas";
            $pesan = "Ayo mulai langkah kecil!";
            $saran = "Kategori obesitas. Disarankan mulai program diet dan aktivitas fisik teratur.";
            $badge = "status-danger";
        }
        
        return back()->with([
            'bmi' => $bmi,
            'status' => $status,
            'pesan' => $pesan,
            'saran' => $saran,
            'gender' => $gender,
            'badge' => $badge
        ]);
    }

    public function kalenderKehamilan() {
        return view('user.mandiri.pages.kehamilan');
    }

    public function kalenderMenstruasi(){
        return view('user.mandiri.pages.menstruasi');
    }

    public function pengingatObat(){
        return view('user.mandiri.pages.obat');
    }
}
