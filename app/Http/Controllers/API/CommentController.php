<?php

namespace App\Http\Controllers\API;

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
        $comments = Comment::with('hospital','creator')->get();
        return ok($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $comment = new Comment();
        $data['created_by'] = $request->created_by;
        $comment->create($data)->get();
        return created($comment,"Comment save successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment =  Comment::where('id',$id)->with('hospital','creator')->get();
        return ok($comment);
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

    public function showReviewByHospital($profile_id)
    {
        $comment =  Comment::where('profile_id',$profile_id)->with('hospital','creator')->get();
        return ok($comment);
    }

    public function showReviewByUser($user_id)
    {
        $comment =  Comment::where('created_by',$user_id)->with('hospital','creator')->get();
        return ok($comment);
    }
}
