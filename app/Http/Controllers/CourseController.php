<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Course::orderBy('id', 'DESC')->paginate(15);
        return view('panel.courses.index', compact('list'));
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.courses.create');
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $data = $request->all();
        $data['ts_expire'] = strtotime($data['ts_expire']);
        $data['ts_register'] = Carbon::now()->timestamp;
        $data['user_id'] = Auth::user()->id;
        Course::create($data);
        return redirect()->route('course.index')->with('store', 'New course created');

    }

    /**
     * Show the form for editing the specified course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['course'] = Course::findOrFail($id);
        return view('panel.courses.edit', compact('data'));
    }

    /**
     * Update the specified course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(CourseRequest $request, $id)
    {
        $data = $request->all();
        $data['ts_expire'] = strtotime($data['ts_expire']);
        $data['ts_update'] = Carbon::now()->timestamp;
        Course::find($id)->update($data);
        return redirect()->route('course.index')->with('edit', 'The selected course has been updated');
    }

    /**
     * Remove the specified course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::destroy($id);
        return redirect()->route('course.index')->with('delete', 'The selected course has been deleted');
    }
}
