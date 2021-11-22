<?php

namespace App\Http\Resources;


use App\Http\Resources\TransactionCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "wallet" => parent::toArray($request),
            // "transfered_transactions" => new TransactionCollection($this->transfered_transactions)
        ];
    }
}
