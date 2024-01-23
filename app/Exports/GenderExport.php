<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GenderExport implements FromView ,ShouldAutoSize
{
    public function view(): View
    {
        return view('statistics.genderReport', [
            'barangays' => session('barangays'),
            'gender'=> session('gender'),
            'countGender'=>session('countGender')
        ]);
    }
}
