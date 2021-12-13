<?php

namespace App\Http\Resources;


use App\Http\Resources\TransactionResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Crypt;

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
        // return $request->all();
        return [
            "address" => $this->address,
            "encrypted_address" => $request->has("encryptAddress") ? Crypt::encryptString($this->address) : "",
            "balance" => $this->balance,
            "user_id" => $this->user_id,
            "owner" => new UserResource($this->whenLoaded("owner")),
            "transfered_transactions" =>
            TransactionResource::collection($this->whenLoaded("transferedTransactions")),
            "received_transactions" =>
            TransactionResource::collection($this->whenLoaded("receivedTransactions"))
        ];
    }
}
