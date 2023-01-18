<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluationRepository implements EvaluationRepositoryInterface
{   

    protected $entity;

    public function __construct(Evaluation $evaluation)
    {
        $this->entity = $evaluation;
    }


    public function newEvaluationOrder(int $idOrder, int $idClient, array $data)
    {
        $evaluation = [
            'client_id' =>$idClient,
            'order_id' => $idOrder,
            'stars' => $data['stars'],
            'comment' => isset($data['comment']) ? $data['comment'] : ''
        ];

        return $this->entity->create($evaluation);
    }

    public function getEvaluationOrder(int $idOrder)
    {
        return $this->entity->where('order_id', $idOrder)->get();
    }


    public function getEvaluationClient(int $idClient)
    {
        return $this->entity->where('client_id', $idClient)->get();
    }


    public function getEvaluationId(int $id)
    {
        return $this->entity->find($id);
    }

}