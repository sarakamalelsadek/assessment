<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'comment_content'=>'required',
            'user_id'=>'required|exists:users,id',
            'article_id'=>'required|exists:articles,id'
           ]);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(),422);
        }
        
        $comment=Comment::create($request->all());
        $success=true;
        $responseArray=['success'=>$success,'res'=>$comment, 'msg'=>''];
        return response()->json($responseArray);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function listComments( Request $request)
    {
        $request->merge(['article_id' => $request->route('article_id')]);
        
        $validator = Validator::make($request->all(), [
            'article_id'=>'required|exists:articles,id'
           ]);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(),422);
        }
        $comments=Comment::where('article_id',$request->route('article_id'))->get();
        if(!$comments){
            $success=false;
            $responseArray=['success'=>$success,'res'=>$comments, 'msg'=>'this article has no comments'];
            return response()->json($responseArray);
        }
        $success=true;
        $responseArray=['success'=>$success,'res'=>$comments, 'msg'=>''];
        return response()->json($responseArray);

    }
}
