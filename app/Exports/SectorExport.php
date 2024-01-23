<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SectorExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('statistics.sectorReport', [
            'barangays' => session('barangays'),
            'sector'=> session('sector'),
            'countSector'=>session('countSector')
        ]);
    }
}
