<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonHomeworkRequest;
use App\Models\CourseLesson;
use App\Models\LessonHomework;
use Illuminate\Support\Carbon;

class LessonHomeworkController extends Controller
{
    /**
     * Display a listing of the homeworks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lessonID)
    {
        if (!is_numeric($lessonID)) {
            return redirect()->route('course.index')->with('invalid-resource', 'Invalid Resource');
        }

        session()->put('lessonID', $lessonID);
        $list = LessonHomework::where('lesson_id', $lessonID)->orderBy('id', 'DESC')->paginate(15);
        return view('panel.homeworks.index', compact('list', 'lessonID'));
    }

    /**
     * Show the form for creating a new homework.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lessonID)
    {
        if (!is_numeric($lessonID)) {
            return redirect()->route('course.index')->with('invalid-resource', 'Invalid Resource');
        }

        $lesson = CourseLesson::find($lessonID);
        if (!$lesson->is_active) {
            return redirect()->route('course.index')->with('invalid-resource', 'You can not add new homework to deactivated lesson');
        }

        session()->put('lessonID', $lessonID);
        return view('panel.homeworks.create');
    }

    /**
     * Store a newly created homework in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonHomeworkRequest $request)
    {
        LessonHomework::create($request->all() + ['ts_register' => Carbon::now()->timestamp, 'lesson_id' => session()->get('lessonID')]);
        return redirect()->to('homework/index/' . session()->get('lessonID'))->with('store', 'New homework created');
    }

    /**
     * Show the form for editing the specified homework.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $homework = LessonHomework::find($id);
        return view('panel.homeworks.edit', compact('homework'));
    }

    /**
     * Update the specified homework in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(LessonHomeworkRequest $request, $id)
    {
        LessonHomework::find($id)->update($request->all());
        return redirect()->to('homework/index/' . session()->get('lessonID'))->with('edit', 'The selected homework has been updated');

    }

    /**
     * Remove the specified homework from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LessonHomework::destroy($id);
        return redirect()->to('homework/index/' . session()->get('lessonID'))->with('delete', 'The selected homework has been deleted');
    }
}
