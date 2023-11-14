<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
use App\Models\Diary;

class DiaryController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"diary"},
     *     summary="Returns a list of diaries",
     *     description="Returns a object of diaries",
     *     path="/V1/course",
     *     @OA\Response(response="200", description="A list with diaries"),
     * ),
     * 
    */
    public function index()
    {
        return Diary::all(); 
    }
 
    /**
     * @OA\Post(
     *     path="/index" ,
     *     tags={"diary"},
     *     summary="Save object of diaries",
     *     description="Sava Returns a object of diaries",
     *     path="/V1/course",
     *     @OA\Response(response="200", description="A list with diaries"),
     * ),
     * 
    */
    public function store(StoreDiaryRequest $request)
    {
        $request->validated();
        $user =  auth()->user();  
        $request->merge(['user_id'=>$user->id]);
        $diary = Diary::query()->firstOrCreate($request->all());
        return response($diary,201);  
    }

    public function show(Diary $diary)
    {
        return $diary;
    }

    
    public function update(UpdateDiaryRequest $request, Diary $diary)
    {
        return $diary->update($request->all()) ? response($diary) : response(null, 400);
    }

    
    public function destroy(Diary $diary)
    {
        $diary->delete();
        return response(null,204);
    }
}
