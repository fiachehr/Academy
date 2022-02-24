<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Factor;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a invoice page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseID)
    {
        $course = Factor::where('user_id', Auth::id())->where('course_id', $courseID)->first();
        if ($course != null) {
            return redirect()->route('panel.dashboard')->with('no-access', 'You can not buy this course again');
        }

        $data['invoiceNumber'] = Carbon::now()->timestamp . rand(1000, 9999);
        $data['course'] = Course::find($courseID);
        if (!$data['course']->is_active) {
            return redirect()->route('panel.dashboard')->with('no-access', 'You can not buy deactivated course');
        }

        session()->put('shopping-data', $data);
        return view('panel.shop.index', compact('data'));
    }

    /**
     * Payment action.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $referenceID = rand(1000000, 9999999);
        Factor::create(
            [
                'number' => session()->get('shopping-data')['invoiceNumber'],
                'user_id' => Auth::user()->id,
                'course_id' => session()->get('shopping-data')['course']->id,
                'prise' => (session()->get('shopping-data')['course']->prise + session()->get('shopping-data')['course']->prise * 0.093),
                'is_paid' => 1,
                'ts_register' => Carbon::now()->timestamp,
                'referenceID' => $referenceID,
            ]
        );
        return redirect()->route('shop.verify', $referenceID);
    }

    /**
     * Display a Verify page.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($referenceID)
    {
        session()->forget('shopping-data');
        return view('panel.shop.verify', compact('referenceID'));
    }

    /**
     * Display a user courses list page.
     *
     * @return \Illuminate\Http\Response
     */

    public function myCourses($type)
    {
        $acceptedType = ['factor', 'course'];
        if (!in_array($type, $acceptedType)) {
            return redirect()->route('panel.dashboard');
        }

        $userCourses = Factor::where('is_paid', 1)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(15);
        if ($type == 'course') {
            return view('panel.shop.myCourses', compact('userCourses'));
        }
        return view('panel.shop.myFactors', compact('userCourses'));
    }

    /**
     * Display user course .
     *
     * @return \Illuminate\Http\Response
     */
    public function courseView($id)
    {
        $course = Factor::where('user_id', Auth::id())->where('course_id', $id)->first();
        if ($course == null) {
            return redirect()->route('panel.dashboard')->with('no-access', 'You have not access to this course');
        }
        return view('panel.shop.courseView', compact('course'));
    }
}
