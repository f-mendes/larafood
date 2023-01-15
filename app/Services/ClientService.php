<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientService
{

    protected $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }


    public function createNewClient(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        
        return  $this->clientRepository->createNewClient($data);
    }

    public function getClient(int $id)
    {
        return $this->clientRepository->getClient($id);
    }
}