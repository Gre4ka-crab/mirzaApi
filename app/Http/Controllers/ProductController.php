<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    /**
     * @param Request $request
     */
    protected function _validate(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image_link' => ['string', 'max:255'],
            'vendor_code' => ['int'],
            'description' => ['string', 'max:255'],
            'price' => ['required', 'int'],
            'purchase_price' => ['int'],
        ]);
    }

    /**
     * @return array
     */
    protected function _getModelData(): array
    {
        return [
            'name' => request('name'),
            'image_link' => request('image_link'),
            'vendor_code' => request('vendor_code'),
            'description' => request('description'),
            'price' => request('price'),
            'purchase_price' => request('purchase_price'),
        ];
    }

    /**
     * Display a listing of the product.
     * @return Collection
     */
    public function index(): Collection
    {
        return Product::all();
    }

    /**
     * Store a newly created product in storage.
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->_validate($request);

        return Product::create($this->_getModelData($request));
    }

    /**
     * Display the specified product.
     * @param Product $product
     * @return string
     */
    public function show(Product $product): string
    {
        return $product;
    }

    /**
     * Update the specified product in storage.
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    public function update(Product $product, Request $request): Response
    {
        $this->_validate($request);

        $success = $product->update($this->_getModelData($request));
        return Response()->noContent($success? 204 : 500);
    }

    /**
     * Remove the specified product from storage.
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product): Response
    {
        $success = $product->delete();

        return Response()->noContent($success? 204 : 500);
    }
}
