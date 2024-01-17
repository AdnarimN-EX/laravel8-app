<?php

namespace App\Exports;

use App\Models\Citizen;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CitizenExport implements FromView
{
    public function view(): View
    {
        return view('citizens.report', [
            'citizen' => session('search_results')
        ]);
    }
}
