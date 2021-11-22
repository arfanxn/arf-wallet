<?php

namespace App\Http\Resources;


use App\Http\Resources\WalletResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //     return [
        //         // "from_wallet" => new  WalletResource($this->whenLoaded("transferedTransactions")),
        //     ];
        return parent::toArray($request);
    }
}
