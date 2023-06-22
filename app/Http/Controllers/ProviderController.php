<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProviderController extends Controller
{

    /**
     * @param Request $request
     */
    protected function _validate(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telegram' => ['telegram', 'max:255'],
            'phone' => ['telegram', 'max:255'],
            'viber' => ['viber', 'max:255'],
            'instagram' => ['instagram', 'max:255'],
            'email' => ['email', 'max:255'],
        ]);
    }

    protected function _getModelData(): array
    {
        return [
            'name' => request('name'),
            'telegram' => request('telegram'),
            'phone' => request('phone'),
            'viber' => request('viber'),
            'instagram' => request('instagram'),
            'email' => request('email'),
        ];
    }

    /**
     * Display a listing of the provider.
     * @return Collection
     */
    public function index(): Collection
    {
        return Provider::all();
    }

    /**
     * Store a newly created provider in storage.
     */
    public function store(Request $request)
    {
        $this->_validate($request);

        return Provider::create($this->_getModelData());
    }

    /**
     * Display the specified provider.
     * @param Provider $provider
     * @return Provider
     */
    public function show(Provider $provider): Provider
    {
        return $provider;
    }

    /**
     * Update the specified provider in storage.
     * @param Request $request
     * @param Provider $provider
     * @return Response
     */
    public function update(Request $request, Provider $provider): Response
    {
        $this->_validate($request);

        $success = $provider->update($this->_getModelData());
        return Response()->noContent($success? 204 : 500);
    }

    /**
     * Remove the specified provider from storage.
     * @param Provider $provider
     * @return Response
     */
    public function destroy(Provider $provider): Response
    {
        $success = $provider->delete();

        return Response()->noContent($success? 204 : 500);
    }
}
