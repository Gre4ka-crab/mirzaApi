<?php

namespace App\Http\Controllers;

use App\Models\Supplies;
use App\Models\SuppliesItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuppliesController extends Controller
{

    /**
     * Display a listing of the supplies.
     * @return Collection
     */
    public function index(): Collection
    {
        return Supplies::all();
    }

    /**
     * Store a newly created supplies in storage.
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request): mixed
    {
        $request->validate([
            'provider_id' => ['required', 'int'],
            'product_ids' => ['required', 'array'],
            'total_price' => ['required', 'int'],
        ]);

        $productIds = $request->get('product_ids');
        $SuppliesItems = [];

        $supply = Supplies::create([
            'provider_id' => request('provider_id'),
            'supplies_item_id' => request('supplies_item_id'),
            'total_price' => request('total_price'),
        ]);

        foreach ($productIds as $productId) {
            $SuppliesItems[] = ['product_id' => $productId, 'supplies_id' => $supply->id];
        }

        SuppliesItem::upsert(
            $SuppliesItems,
            ['product_id', 'supplies_id'], ['product_id']
        );

        $supply->supplies_item_id = $supply->id;

        $supply->save();

        return $supply;
    }

    /**
     * Display the specified supplies.
     * @param Supplies $supplies
     * @return Supplies
     */
    public function show(Supplies $supplies): Supplies
    {
        $supplies->supplyItems;
        return $supplies;
    }

    /**
     * Update the specified supplies in storage.
     * @param Request $request
     * @param Supplies $supplies
     * @return Response
     */
    public function update(Request $request, Supplies $supplies): Response
    {
        $request->validate([
            'provider_id' => ['required', 'int'],
            'supplies_item_id' => ['required', 'int'],
            'total_price' => ['required', 'int'],
        ]);

        $success = $supplies->update([
            'provider_id' => request('provider_id'),
            'supplies_item_id' => request('supplies_item_id'),
            'total_price' => request('total_price'),
        ]);
        return Response()->noContent($success ? 204 : 500);
    }

    /**
     * Remove the specified supplies from storage.
     * @param Supplies $supplies
     * @return Response
     */
    public function destroy(Supplies $supplies): Response
    {
        $success = $supplies->delete();

        return Response()->noContent($success ? 204 : 500);
    }
}
