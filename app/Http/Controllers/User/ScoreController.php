<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use PDF;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course_id = $_GET['course'];
        $exam = Exam::where('course_id',$course_id)->first();
        return view('user.users_profile.exams.index',compact('exam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $score = Score::where('course_id',$request->course_id)->where('exam_id',$request->exam)->where('user_id',auth()->user()->id)->first();
        // $old_score = $score->total_grade;

        if($score != null){
            $old_score = $score->total_grade;
            $score->update([
                'total_grade' => 0.00,
            ]);
            if($request->answer != null){
                foreach($request->answer as $key => $ans){
                    if($ans == $request->true_answer[$key]){
                        $score->update([
                            'total_grade' => $score->total_grade + $request->grade[$key],
                        ]);
                    }else{
                        $score->update([
                            'total_grade' => $score->total_grade + 0,
                        ]);
                    }
                }
            }
        }
        if($old_score > $score->total_grade){
            $score->update([
                'total_grade' => $old_score,
            ]);
        }
        $exam = Exam::where('id',$request->exam)->first();
        alert()->success('پاسخ های شما به درستی ذخیره شدند', 'با تشکر');
        return view('user.users_profile.exams.index',compact('exam'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        $score = Score::where('course_id',$exam->course->id)->where('exam_id',$exam->id)->where('user_id',auth()->user()->id)->first();
        
        if(!empty($score)){
            if($exam->allowed_times == $score->exam_visit){
                alert()->warning('شما اجازه شرکت در آزمون را ندارید', 'دقت کنید')->persistent('باشه');
                return redirect()->back();
            }else{
                $questions = Question::where('exam_id',$exam->id)->orderBy(DB::raw('RAND()'))->take($exam->counter_of_questions)->get();
                // $question1 = $questions->chunk(1)->all();
                // dd($questions);
    
                if($score == null){
                    Score::create([
                        'course_id' => $exam->course->id,
                        'exam_id' => $exam->id,
                        'user_id' => auth()->user()->id,
                        'exam_visit' => 1,
                    ]);
                }else{
                    $score->update([
                        'exam_visit' => $score->exam_visit + 1,
                    ]);
                }
                return view('user.users_profile.exams.show',compact('questions','exam'));
            }
        }else{
            $questions = Question::where('exam_id',$exam->id)->orderBy(DB::raw('RAND()'))->take($exam->counter_of_questions)->get();
    
                if($score == null){
                    Score::create([
                        'course_id' => $exam->course->id,
                        'exam_id' => $exam->id,
                        'user_id' => auth()->user()->id,
                        'exam_visit' => 1,
                    ]);
                }else{
                    $score->update([
                        'exam_visit' => $score->exam_visit + 1,
                    ]);
                }
                return view('user.users_profile.exams.show',compact('questions','exam'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function index_certificate()
    {
        $scores = Score::where('user_id',auth()->user()->id)->latest()->paginate(10);
        return view('user.users_profile.certificate.index',compact('scores'));
    }
    public function show_certificate(Score $score)
    {
        return view('user.users_profile.certificate.show',compact('score'));
    }

    // public function download_certificate(Score $score)
    // {
    //     $type = $_GET['type'];
    //     if (!empty($type)) {
    //         if ($type == 'pdf') {
    //             $pdfFile = PDF::loadView('user.users_profile.certificate.report', compact('score'));
    //             return $pdfFile->download('report.pdf');
    //         }
    //     }

    //     // $pdf = PDF::loadView('user.users_profile.certificate.report', compact('score'));
    //     // return $pdf->download('document.pdf');

    //     // $data = [
    //     //     'foo' => 'bar'
    //     // ];
    //     // $pdf = PDF::loadView('user.users_profile.certificate.report', compact('score'), $data);
    //     // return $pdf->stream('document.pdf');
    //     return redirect()->back();
    // }
}
