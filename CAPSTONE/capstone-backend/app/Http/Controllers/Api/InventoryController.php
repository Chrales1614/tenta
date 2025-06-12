<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InventoryController extends Controller
{
    public function index(): JsonResponse
    {
        $items = InventoryItem::all();
        return response()->json($items);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'min_quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'last_restock_date' => 'nullable|date',
            'description' => 'nullable|string'
        ]);

        $item = InventoryItem::create($validated);
        return response()->json($item, 201);
    }

    public function show(InventoryItem $inventoryItem): JsonResponse
    {
        return response()->json($inventoryItem);
    }

    public function update(Request $request, InventoryItem $inventoryItem): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'category' => 'string|max:255',
            'quantity' => 'integer|min:0',
            'min_quantity' => 'integer|min:0',
            'unit' => 'string|max:50',
            'last_restock_date' => 'nullable|date',
            'description' => 'nullable|string'
        ]);

        $inventoryItem->update($validated);
        return response()->json($inventoryItem);
    }

    public function destroy(InventoryItem $inventoryItem): JsonResponse
    {
        $inventoryItem->delete();
        return response()->json(null, 204);
    }

    public function lowStock(): JsonResponse
    {
        $lowStockItems = InventoryItem::whereRaw('quantity <= min_quantity')->get();
        return response()->json($lowStockItems);
    }
} 