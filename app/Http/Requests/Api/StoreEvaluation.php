<?php

namespace App\Http\Requests\Api;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $client = auth()->user();
        
        $order = app(OrderRepositoryInterface::class)->getOrderByIdentify($this->identify);

        return $order->client_id == $client->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stars' => ['required','integer','min:1','max:5'],
            'comment' => ['nullable', 'min:3', 'max:1000']
        ];
    }
}
