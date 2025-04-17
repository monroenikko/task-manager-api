<?php

namespace App\Services;

use App\Http\Resources\Task\ShowResource;
use App\Repositories\TaskRepository;
use App\Traits\ResponseApi;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TaskService
{
    use ResponseApi;

    protected $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTasks($data)
    {
        try {

            $res = new \App\Http\Resources\Task\ShowAllResource($this->repository->getAll($data));

            return $this->success(
                'Data Successfully Fetched.',
                Response::HTTP_OK,
                $res
            );
        } catch (Exception $e) {

            return $this->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function getById($id)
    {
        try {
            $res = $this->repository->getById($id);
            if (!isset($res)) {
                return $this->error('No Task Found', Response::HTTP_BAD_REQUEST);
            }
            return $this->success(
                'Data Successfully Fetched.',
                Response::HTTP_OK,
                new ShowResource($res)
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function createTask($data)
    {
        DB::beginTransaction();
        try {

            $res = $this->repository->store($data->validated());

            DB::commit();

            return $this->success(
                'Task Successfully Created.',
                Response::HTTP_CREATED,
                $res
            );
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateTask($data, $id)
    {
        DB::beginTransaction();
        try {
            $task = $this->repository->getById($id);
            if (!isset($task)) {
                return $this->error('No Task Found', Response::HTTP_BAD_REQUEST);
            }
            $res = $this->repository->update($data->validated(), $task);

            DB::commit();

            return $this->success(
                'Task Successfully Updated.',
                Response::HTTP_OK,
                new ShowResource($res)
            );
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function deleteTask($id)
    {
        DB::beginTransaction();
        try {
            $task = $this->repository->getById($id);
            if (!isset($task)) {
                return $this->error('No Task Found', Response::HTTP_BAD_REQUEST);
            }
            $res = $this->repository->delete($task);
            DB::commit();

            return $this->success(
                'Task Successfully Deleted.',
                Response::HTTP_OK,
                $res
            );
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
