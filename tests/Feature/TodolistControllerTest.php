<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "john",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Eko"
                ],
                [
                    "id" => "2",
                    "todo" => "Kurniawan"
                ]
            ]
        ])->get('/home')
            ->assertSeeText("1")
            ->assertSeeText("Eko")
            ->assertSeeText("2")
            ->assertSeeText("Kurniawan");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "john"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is Required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "john"
        ])->post("/todolist", [
            "todo" => "Eko"
        ])->assertRedirect("/home");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "john",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Eko"
                ],
                [
                    "id" => "2",
                    "todo" => "Kurniawan"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/home");
    }


}
