<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfiguracionCargaRequest;
use Illuminate\Http\Request;
use App\Models\ConfiguracionCarga;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\ConfiguracionCargaService;

class ConfiguracionCargaController extends Controller
{   
    protected $service;
    public function __construct(ConfiguracionCargaService $service){
        $this->service = $service;
    }
    public function index()
    {
        return $this->service->getAll();
    }

    public function add(ConfiguracionCargaRequest $request): JsonResponse {
        $data = $this->service->create($request->validated());
        return response()->json($data, 201);
    }

    public function upd(ConfiguracionCargaRequest $request, $id): JsonResponse {
        $data = $this->service->update($id, $request->validated());
        return response()->json($data, 200);
    }

    public function deleted($id): JsonResponse {
        return response()->json($this->service->delete($id), 204);
    }
}
