<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::latest()->paginate(10);
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.exams.create' , compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        // dd($request->all());
        $request->validate([
            'course_id' => 'required|integer',
            'name' => 'required|min:3|max:300',
            'time' => 'required|integer',
            'randon_number' => 'required|integer',
            'final_grade' => 'required',
            'description' => 'required|min:5|max:800',
            'allowed_times' => 'required',
            'text.*' => 'required',
            'q1.*' => 'required',
            'q2.*' => 'required',
            'q3.*' => 'required',
            'q4.*' => 'required',
            'grade.*' => 'required',
            'true_answer.*' => 'required',
        ]);

        if ($request->czContainer_czMore_txtCount == 0) {
            return redirect()->back()->withErrors(['msg' => 'اضافه کردن سوال الزامی است']);
        }
        if ($request->has('czContainer_czMore_txtCount')) {

            Exam::create([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'time' => $request->time,
                'counter_of_questions' => $request->randon_number,
                'final_grade' => $request->final_grade,
                'is_active' => $request->is_active,
                'description' => $request->description,
                'allowed_times' => $request->allowed_times,
            ]);
        }

        try {
            DB::beginTransaction();

            if ($request->has('czContainer_czMore_txtCount')) {

                $count = $request->czContainer_czMore_txtCount;
                $exam = Exam::where('course_id',$request->course_id)->where('name',$request->name)->first();

                for ($i=0 ; $i < $count ; $i++) {
                    Question::create([
                        'exam_id' => $exam->id,
                        'text' => $request->text[$i],
                        'q1' => $request->q1[$i],
                        'q2' => $request->q2[$i],
                        'q3' => $request->q3[$i],
                        'q4' => $request->q4[$i],
                        'grade' => $request->grade[$i],
                        'true_answer' => $request->true_answer[$i],
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد امتحان', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('ایجاد آزمون دوره با موفقیت انجام شد', 'باتشکر');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $questions = Question::where('exam_id',$exam->id)->get();
        return view('admin.exams.show' , compact('exam','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
        $questions = Question::where('exam_id',$exam->id)->get();
        $courses = Course::all();
        return view('admin.exams.edit' , compact('exam','questions','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        // dd($request->all());
        $request->validate([
            'course_id' => 'required|integer',
            'name' => 'required|min:3|max:300',
            'time' => 'required|integer',
            'randon_number' => 'required|integer',
            'final_grade' => 'required',
            'description' => 'required|min:5|max:800',
            'allowed_times' => 'required',
            'text.*' => 'required',
            'q1.*' => 'required',
            'q2.*' => 'required',
            'q3.*' => 'required',
            'q4.*' => 'required',
            'grade.*' => 'required',
            'true_answer.*' => 'required',
        ]);

            $exam->update([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'time' => $request->time,
                'counter_of_questions' => $request->randon_number,
                'final_grade' => $request->final_grade,
                'is_active' => $request->is_active,
                'description' => $request->description,
                'allowed_times' => $request->allowed_times,
            ]);

        try {
            DB::beginTransaction();

                $questions = Question::where('exam_id',$exam->id)->get();
                foreach ($questions as $i => $question) {
                    $question->update([
                        'exam_id' => $exam->id,
                        'text' => $request->text[$i],
                        'q1' => $request->q1[$i],
                        'q2' => $request->q2[$i],
                        'q3' => $request->q3[$i],
                        'q4' => $request->q4[$i],
                        'grade' => $request->grade[$i],
                        'true_answer' => $request->true_answer[$i],
                    ]);
                }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش امتحان', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('ویرایش امتحان دوره با موفقیت انجام شد', 'باتشکر');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function remove_question(Request $request)
    // {
    //     // if(Gate::allows('inaccessible-management-page')) return view('auth.inaccessible');
    //     Question::destroy($request->question_id);
    //     alert()->success('سوال مورد نظر حذف شد', 'باتشکر');
    //     return redirect()->route('admin.exams.edit');
    // }

    public function add_question(Request $request , Exam $exam)
    {
        // dd($request->all());
        $request->validate([
            'text.*' => 'required',
            'q1.*' => 'required',
            'q2.*' => 'required',
            'q3.*' => 'required',
            'q4.*' => 'required',
            'grade.*' => 'required',
            'true_answer.*' => 'required',
        ]);

        if ($request->czContainer_czMore_txtCount == 0) {
            return redirect()->back()->withErrors(['msg' => 'اضافه کردن سوال الزامی است']);
        }

        try {
            DB::beginTransaction();

            if ($request->has('czContainer_czMore_txtCount')) {
                $count = $request->czContainer_czMore_txtCount;
                for ($i=0 ; $i < $count ; $i++) {
                    Question::create([
                        'exam_id' => $exam->id,
                        'text' => $request->text[$i],
                        'q1' => $request->q1[$i],
                        'q2' => $request->q2[$i],
                        'q3' => $request->q3[$i],
                        'q4' => $request->q4[$i],
                        'grade' => $request->grade[$i],
                        'true_answer' => $request->true_answer[$i],
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد سوال', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('ایجاد سوال دوره با موفقیت انجام شد', 'باتشکر');
        return redirect()->back();
    }
}
