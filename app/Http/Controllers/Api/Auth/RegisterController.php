<?php

namespace App\Http\Controllers\Api\Auth;


use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreClient;
use App\Http\Resources\ClientResource;


class RegisterController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $client)
    {
        $this->clientService = $client;
    }

    public function store(StoreClient $request)
    {
        $client = $this->clientService->createNewClient($request->all());

        return new ClientResource($client);
    }
}
