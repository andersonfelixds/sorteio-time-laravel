<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
use App\Models\Diary;

class DiaryController extends Controller
{
   
    public function index()
    {
        return Diary::all(); 
    }
 
    public function store(StoreDiaryRequest $request)
    {
        $request->validated(); 
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
