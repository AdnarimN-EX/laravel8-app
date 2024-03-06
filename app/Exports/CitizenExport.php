<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CitizenExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('citizens.report', [
            'citizen' => session('search_results')
        ]);
    }
}
