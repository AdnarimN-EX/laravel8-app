<?php

namespace App\Http\Controllers;

use App\Exports\CitizenExport;
use App\Models\Citizen;
use App\Models\Citizens;
use App\Models\DependentRange;
use App\Models\FamilyIncomeRange;
use App\Models\Gender;
use App\Models\HealthCondition;
use App\Models\LivelihoodStatus;
use App\Models\TenurialStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CitizensController extends Controller
{
    //
    public function index(Request $request){
        $barangay = Citizen::$barangays;
        $gender = Gender::all();
        
        $query = Citizen::FilterSearch($request);
    
        // Get the unpaginated results
        $unpaginatedResults = $query->get();
    
        // Paginate the results while maintaining filters
        $paginatedResult = $query->paginate(20)->appends(request()->query());
    
        // Store unpaginated data into session 
        session(['search_results' => $unpaginatedResults]);
    
        return view('citizens.index', [
            'citizens' => $paginatedResult,
            'message' => $unpaginatedResults->isEmpty() ? 'No results found' : null,
            'barangay' => $barangay,
            'gender' => $gender,
        ]);
    }
    
    public function report(){
        $reportData = session('search_results');

        $pdf = Pdf::loadView('citizens.report', ['citizen' => $reportData])->setPaper('a4', 'landscape');

        return $pdf->stream('report.pdf');
    }

    public function reportExcel(){
        return Excel::download(new CitizenExport, 'citizens.xlsx');
    }
    
    public function create()
    {
        $gender = Gender::all();
        $barangay = Citizen::$barangays;
        $liveStatus = LivelihoodStatus::all();
        $hCondition = HealthCondition::all();
        $tenantStatus = TenurialStatus::all();
        $familyIncome = FamilyIncomeRange::all();
        $dependentRange = DependentRange::all();


        return view('citizens.create', [
            //for Citizen Table
            'gender' => $gender,
            'barangay' => $barangay,
            //for Profile Table
            'liveStatus'=>$liveStatus,//livelihood_status_id
            'familyIncome' => $familyIncome,//family_income_range_id
            'tenantStatus' => $tenantStatus,//tenurial_status_id
            'dependentRange' => $dependentRange,//dependent_range_id
            'hCondition' => $hCondition,//livelihood_status_id
            
        ]);

    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'surname' => 'required|alpha',
            'forename' => 'required|alpha',
            'midname' => 'required|alpha',
            'suffix' => 'nullable',
            'birthdate' => 'required|before:today|after:1900-01-01',
            'gender_id' => 'required|numeric',
            'vicinity' => 'required',
            'barangay_id' => 'required|numeric',
            'avatar' => 'required'
        ]);

        $requestData = $request->all();
        $fileName = time() . $request->file('avatar')->getClientOriginalName();
        $path = $request->file('avatar')->storeAs('avatar', $fileName, 'public');
        $requestData["avatar"] = '/storage/' . $path;

        Citizen::create($requestData);
        return redirect(route('citizens.index'));
    }

    public function testing(){
        return view('citizens.testing');
    }
}