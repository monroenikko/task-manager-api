<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Task\TaskStoreRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return $this->service->getAllTasks($request);
    }

    public function store(TaskStoreRequest $request)
    {
        return $this->service->createTask($request);
    }

    public function show($id)
    {
        return $this->service->getById($id);
    }

    public function update(TaskStoreRequest $request, $id)
    {
        return $this->service->updateTask($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->deleteTask($id);
    }

}
