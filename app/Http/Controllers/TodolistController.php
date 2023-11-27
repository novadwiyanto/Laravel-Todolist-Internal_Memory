<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService) {
        $this->todolistService = $todolistService;
    }

    public function todolist(Request $request) {
        $todolist = $this->todolistService->getTodo();
        return response()->view("user.home", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request) {
        $todo = $request->input('todo');

        if (empty($todo)) {
            $todolist = $this->todolistService->getTodo();
            return response()->view("user.home", [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todo is Required"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodolistController::class, 'todolist']);
    }

    public function removeTodo(Request $request, string $todoId) {
        $this->todolistService->removeTOdo($todoId);

        return redirect()->action([TodolistController::class, 'todolist']);

    }
}
