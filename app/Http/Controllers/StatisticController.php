<?php

namespace App\Http\Controllers;

use App\Exports\CitizenExport;
use App\Exports\GenderExport;
use App\Exports\SectorExport;
use App\Exports\UsersExport;
use App\Models\Citizen;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class StatisticController extends Controller
{
    //
    public function genderStats()
    {
        $citizen = new Citizen();
        $genderCounts = $citizen->getGenderStats();

        return view('statistics.genderStats', [
            'barangays' => session('barangays'),
            'gender' => session('gender'),
            'countGender' => $genderCounts,
        ]);
    }

    public function sectorStats()
    {
        $citizen = new Citizen();
        $countSector = $citizen->getSectorStats();

        return view('statistics.sectorStats', [
            'barangays' => session('barangays'),
            'sector' => session('sector'),
            'countSector' => $countSector,
        ]);
    }

    public function reportGender()
    {
        $barangay = session('barangays');
        $gender = session('gender');
        $countGender = session('countGender');

        $pdf = Pdf::loadView('statistics.genderReport', ['barangays' => $barangay, 'gender' => $gender, 'countGender' => $countGender])->setPaper('a4', 'landscape');

        return $pdf->stream('report.pdf');
    }

    public function reportSector()
    {
        $barangay = session('barangays');
        $sector = session('sector');
        $countSector = session('countSector');

        $pdf = Pdf::loadView('statistics.sectorReport', ['barangays' => $barangay, 'sector' => $sector, 'countSector' => $countSector])->setPaper('a4', 'landscape');

        return $pdf->stream('report.pdf');
    }

    public function excelAllGender()
    {
        return Excel::download(new GenderExport, 'gender.xlsx');
    }
    public function excelAllSector()
    {
        return Excel::download(new SectorExport, 'sector.xlsx');
    }
}
