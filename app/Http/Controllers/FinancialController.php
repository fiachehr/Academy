<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    /**
     * Display a factors list page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCourses = Factor::orderBy('id', 'DESC')->paginate(15);
        return view('panel.financial.index', compact('userCourses'));
    }

    /**
     * Display a report page.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        $data['totalSales'] = Factor::sum('prise');
        $data['bestCourse'] = Factor::select('course_id', DB::raw('count(*) as total'))->groupBy('course_id')->orderBy('total', 'DESC')->take(5)->get();
        $data['bestSeller'] = Factor::select('user_id', DB::raw('count(*) as total'))->groupBy('user_id')->orderBy('total', 'DESC')->take(5)->get();
        return view('panel.financial.report', compact('data'));
    }
}
