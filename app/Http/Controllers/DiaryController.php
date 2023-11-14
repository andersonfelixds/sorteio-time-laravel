<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
use App\Models\Diary;
use Illuminate\Support\Carbon;

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
        $validateDiary = $this->validaDayDiary($request->start_at);
        if(!$validateDiary->error){ 
            $request->merge(['user_id'=>$user->id]);
            $diary = Diary::query()->firstOrCreate($request->all());
            return response($diary,201);  
        }
        return response(json_encode($validateDiary),203);  
        
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

    public function validaDayDiary(String $start_at) 
    {
        $message = ['error'=>false, 'message' => 'Final de semana não é possivel realizar agendamento']; 

        if(!$this->isWeekDiary($start_at)) {
            $message =  ['error'=>true, 'message' => 'Final de semana não é possivel realizar agendamento'];
        }
        if(!$this->existDiary($start_at)){
            $message = ['error'=>true, 'message' => 'Já existe agendamento nesse mesmo periodo',];
        }

        return (object) $message; 

    }

    public function existDiary(String $start_at) 
    {
        $startAt = new Carbon($start_at);

        $diary = Diary::where("start_at",">=",$startAt)->
                             where("deadline_at","<=",$startAt)->get();   

        return $this->isFreeDiary($diary);
    }

    public function isFreeDiary($diary) 
    {
       if(count($diary)==0) {
            return true; 
       }
       return false; 
    }

    public function isWeekDiary($start_at) 
    {
        
        $day = substr($start_at, 8, 2);
        $month = substr($start_at, 5, 2);
        $year = substr($start_at, 0, 4);
        $date = date('w', mktime(0, 0, 0, $month, $day, $year));

        if ($date == 6 || $date == 0) {
            return false; 
        }
        return true;
          
    }
}
