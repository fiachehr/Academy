<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseLessonRequest;
use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Support\Carbon;

class CourseLessonController extends Controller
{
    /**
     * Display a listing of the lessons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courseID)
    {
        if (!is_numeric($courseID)) {
            return redirect()->route('course.index')->with('invalid-resource', 'Invalid Resource');
        }

        session()->put('courseID', $courseID);
        $list = CourseLesson::where('course_id', $courseID)->orderBy('id', 'DESC')->paginate(15);
        return view('panel.lessons.index', compact('list', 'courseID'));
    }

    /**
     * Show the form for creating a new lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($courseID)
    {
        if (!is_numeric($courseID)) {
            return redirect()->route('course.index')->with('invalid-resource', 'Invalid Resource');
        }

        $course = Course::find($courseID);
        if (!$course->is_active || $course->is_finished) {
            return redirect()->route('course.index')->with('invalid-resource', 'You can not add new lesson to deactivated or finished course');
        }

        session()->put('courseID', $courseID);
        return view('panel.lessons.create');
    }

    /**
     * Store a newly created lesson in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseLessonRequest $request)
    {
        CourseLesson::create($request->all() + ['ts_register' => Carbon::now()->timestamp, 'course_id' => session()->get('courseID')]);
        return redirect()->to('lesson/index/' . session()->get('courseID'))->with('store', 'New lesson created');
    }

    /**
     * Show the form for editing the specified lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = CourseLesson::find($id);
        return view('panel.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified lesson in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(CourseLessonRequest $request, $id)
    {
        CourseLesson::find($id)->update($request->all());
        return redirect()->to('lesson/index/' . session()->get('courseID'))->with('edit', 'The selected lesson has been updated');

    }

    /**
     * Remove the specified lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CourseLesson::destroy($id);
        return redirect()->to('lesson/index/' . session()->get('courseID'))->with('delete', 'The selected lesson has been deleted');
    }
}
