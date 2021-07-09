<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::all();
        $success=true;
        $responseArray=['success'=>$success,'res'=>$articles,'msg'=>''];
        return response()->json($responseArray);    }

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
            'body'=>'required|string',
            'category_id'=>'required|exists:categories,id'
           ]);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(),422);
        }
        
        $article=Article::create($request->all());
        $success=true;
        $responseArray=['success'=>$success,'res'=>$article, 'msg'=>''];
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
        $article=Article::find($id);
        if(!$article){
            $success=false;
            $responseArray=['success'=>$success,'res'=>$article, 'msg'=>'article is not exists'];
            return response()->json($responseArray);
        }
        $success=true;
        $responseArray=['success'=>$success,'res'=>$article, 'msg'=>''];
        return response()->json($responseArray);

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
        
        $validator = Validator::make($request->all(), [
            'body'=>'string',
            'category_id'=>'exists:categories,id'
           ]);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(),422);
        }
        $article=Article::find($id);
        if(!$article){
            $success=false;
            $responseArray=['success'=>$success,'res'=>$article, 'msg'=>'article is not exists'];
            return response()->json($responseArray);
        }
        $article->update($request->all());
        $success=true;
        $responseArray=['success'=>$success,'res'=>$article, 'msg'=>''];
        return response()->json($responseArray);

    }

      /**
     * search the specified resource 
     *
     * @param  int  $category_id
     * @return \Illuminate\Http\Response
     */
    public function searchByCategory_id( Request $request)
    {
        $request->merge(['category_id' => $request->route('category_id')]);
        
        $validator = Validator::make($request->all(), [
            'category_id'=>'required|exists:categories,id'
           ]);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(),422);
        }
        $article=Article::where('category_id',$request->route('category_id'))->get();
        if(!$article){
            $success=false;
            $responseArray=['success'=>$success,'res'=>$article, 'msg'=>'this category has no articles'];
            return response()->json($responseArray);
        }
        $success=true;
        $responseArray=['success'=>$success,'res'=>$article, 'msg'=>''];
        return response()->json($responseArray);

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
}
