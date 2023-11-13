<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class DiaryTest extends TestCase
{
    public function test_store()
    {
        $diary = new Diary();
        $diary->title = fake('pt_BR')->name();
        $diary->description = fake('pt_BR')->name();
        $diary->start_at = new Carbon('2024-01-23 11:53:20');,
        $diary->deadline_at = new Carbon('2024-01-23 11:53:20');,
        $diary->conclusion_at = new Carbon('2024-01-23 11:53:20');,
        $diary->type_diary_id = 1,
      
        $response = $this->post("/api/diary", $diary->toArray());
        $response->assertStatus(201);
    }

    public function test_destroy()
    {
        $diary = Diary::query()->inRandomOrder()->first();
        $response = $this->delete("/api/diary/{$diary->id}");
        $response->assertStatus(204);
    }
}