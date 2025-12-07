<?php

namespace App\Helpers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Prescription;

class PrescriptionPdfHelper
{
    public static function download(Prescription $prescription)
    {
        $pdf = Pdf::loadView(
            'pdf.prescription',
            [
                'prescription' => $prescription,
                'doctor' => $prescription->consultation->doctor,
                'patient' => $prescription->consultation->user,
                'items' => $prescription->items,
            ]
        )
        ->setPaper('A4')
        ->setOption([
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);

        $filename = 'Resep_' . $prescription->id . '_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }
}
