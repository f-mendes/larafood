<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\EvaluationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEvaluation;
use App\Http\Resources\EvaluationResource;

class EvaluationApiController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;

    }

    public function store(StoreEvaluation $request)
    {   
        
        $data = $request->only('stars', 'comment');
       
        $evaluation = $this->evaluationService->createNewEvaluation($request->identify, $data);
        
        return (new EvaluationResource($evaluation))->response()->setStatusCode(201);
    }
}
