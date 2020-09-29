<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CRUDController extends BaseController
{
    protected $classModel;

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 25);
        $paginate = $this->classModel::paginate($perPage);

        return response()->json($paginate, 200);
    }

    protected function hook_validate_store(Request $request)
    {

    }

    public function store(Request $request): JsonResponse
    {
        $this->hook_validate_store($request);

        $object = $this->classModel::create($request->post());

        return response()->json($object, 200);
    }

    public function show(int $id): JsonResponse
    {
        $object = $this->classModel::find($id);

        return response()->json($object, 200);
    }

    protected function hook_validate_update(int $id, Request $request)
    {

    }

    public function update(int $modelId, Request $request)
    {
        $this->hook_validate_update($modelId, $request);

        $object = $this->classModel::find($modelId);
        $object->update($request->post());

        return response()->json($object, 200);
    }

    public function destroy(int $modelId)
    {
        $this->classModel::destroy($modelId);

        return response()->json(['status' => true], 200);
    }
}
