<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovementsController extends Controller
{
    public function getProductMovements($productId)
    {
        try {
            $movements = \App\Managers\Movement\GetProductMovementsManager::execute($productId);
            return response()->json($movements, 200);
        } catch (\Error $error) {
            return response()->json(404);
        }
    }
    public function store(Request $request)
    {
        $movementData = $request->all();
        try {
            $movement = \App\Managers\Movement\CreateMovementManager::execute($movementData);
            return response()
                ->json($movement, 200);
        } catch (\Exception $error) {
            return response()
                ->json(['error' => $error->getMessage()], 400);
        }
    }
}
