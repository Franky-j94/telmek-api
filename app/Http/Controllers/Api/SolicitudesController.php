<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SolicitudesService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SolicitudesRequest;
use App\Models\User;
use Carbon\Carbon;

class SolicitudesController extends Controller
{
    protected $service;

    public function __construct(SolicitudesService $service)
    {
        $this->service = $service;
    }
    //
    public function index()
    {
        return $this->service->getAll();
    }
    public function usersAsesorVentas() {
        $usuarios = User::where('activo', 1)
            ->whereHas('grupo', function ($query) {
                $query->where('descripcion_grupo', 'Asesor de ventas');
            })
            ->get();

        return response()->json([
            'data' => $usuarios
        ]);
    }
    public function add(SolicitudesRequest $request): JsonResponse {
        // se agrega el usuario que tengas menos solicitudes
        
        $data = $this->service->create($request->validated());
        return response()->json($data, 201);
    }

    public function upd(SolicitudesRequest $request, $id): JsonResponse {
        $data = $this->service->update($id, $request->validated());
        return response()->json($data, 200);
    }

    public function deleted($id): JsonResponse {
        return response()->json($this->service->delete($id), 204);
    }

    public function cancelar($id): JsonResponse {
        return response()->json($this->service->cancel($id), 200);
    }
}
