<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('admin.comments.index' , compact('comments'));
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
        $request->validate([
            'text' => 'required|min:5|max:7000',
        ]);
        Comment::create([
            'user_id' => auth()->id(),
            'course_id' => $request->course,
            'answer_to' => $request->answer_to,
            'approved' => 1,
            'text' => $request->text,
        ]);

        alert()->success('پاسخ دیدگاه شما با موفقیت ثبت شد' , 'با تشکر');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.show' , compact('comment'));
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
    public function update(Request $request, Comment $comment)
    {
        // dd($comment);
        $request->validate([
            'text' => 'required|min:5|max:7000',
        ]);
        $comment->update([
            'text' => $request->text,
        ]);

        alert()->success('پاسخ دیدگاه شما با موفقیت ویرایش شد' , 'با تشکر');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        alert()->success('وضعیت کامنت مورد نظر به درستی حذف شد', 'با تشکر');
        return redirect()->route('admin.comments.index');
    }
    public function changeApprove(Comment $comment)
    {
        if($comment->getRawOriginal('approved')){
            $comment->update([
                'approved' => 0
            ]);
        }else{
            $comment->update([
                'approved' => 1
            ]);
        }

        alert()->success('وضعیت کامنت مورد نظر به درستی تغییر کرد', 'با تشکر');
        return redirect()->route('admin.comments.index');
    }
}
