<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{

    /**
     * @param Request $request
     */
    protected function _validate(Request $request){
        $request->validate([
            'status' => ['required', Rule::in(Order::$statuses)],
            'product_id' => ['required', 'int'],
            'total_order' => ['required', 'int'],
        ]);
    }

    protected function _getModelData(): array
    {
        return [
            'status' => request('status'),
            'product_id' => request('product_id'),
            'total_order' => request('total_order'),
        ];
    }


    /**
     * Display a listing of the order.
     * @return Collection
     */
    public function index(): Collection
    {
        return Order::all();
    }

    /**
     * Store a newly created order in storage.
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request): mixed
    {
        $this->_validate($request);

        return Order::create($this->_getModelData());
    }

    /**
     * Display the specified order.
     * @param Order $order
     * @return Order
     */
    public function show(Order $order): Order
    {
        return $order;
    }

    /**
     * Update the specified order in storage.
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function update(Request $request, Order $order): Response
    {
        $this->_validate($request);

        $success = $order->update($this->_getModelData());
        return Response()->noContent($success? 204 : 500);
    }

    /**
     * Remove the specified order from storage.
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order): Response
    {
        $success = $order->delete();

        return Response()->noContent($success? 204 : 500);
    }
}
