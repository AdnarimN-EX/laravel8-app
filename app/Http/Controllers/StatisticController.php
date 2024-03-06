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
        $genderCounts = [];
    
        Citizen::select('barangay', 'gender_id')
            ->orderBy('barangay')
            ->orderBy('gender_id')
            ->chunk(10000, function ($citizens) use (&$genderCounts) {
                foreach ($citizens as $citizen) {
                    $key = $citizen->barangay . '-' . $citizen->gender_id;
                    if (!isset($genderCounts[$key])) {
                        $genderCounts[$key] = 1;
                    } else {
                        $genderCounts[$key]++;
                    }
                }
            });
    
        // Assuming you have a way to get barangay and gender names
        // Here, adapt your logic to match gender IDs to names and compile the data as needed for your view
    
        // Assuming session('barangays') and session('gender') are arrays/lists you've previously set
        $barangays = session('barangays');
        $genders = session('gender');
    
        // Preparing data for the view in the format it expects
        $compiledResults = [];
        foreach ($barangays as $barangay) {
            foreach ($genders as $gender) {
                $key = $barangay . '-' . $gender->id;
                $compiledResults[$barangay][$gender->name] = $genderCounts[$key] ?? 0;
            }
        }
    
        return view('statistics.genderStats', [
            'barangays' => $barangays,
            'gender' => $genders,
            'countGender' => $compiledResults,
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
