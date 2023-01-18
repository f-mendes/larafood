<?php

namespace App\Repositories\Contracts;


interface EvaluationRepositoryInterface 
{
    public function newEvaluationOrder(int $idOrder, int $idClient, array $data);
    public function getEvaluationOrder(int $idOrder);
    public function getEvaluationClient(int $idClient);
    public function getEvaluationId(int $id);
    
}