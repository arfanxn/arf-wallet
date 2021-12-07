<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            "id" => $this->id,
            "tx_hash" => $this->tx_hash,
            "from_wallet_id" => $this->from_wallet_id,
            "to_wallet_id" => $this->to_wallet_id,
            "from_wallet" => new WalletResource($this->whenLoaded("fromWallet")),
            "to_wallet" => new WalletResource($this->whenLoaded("toWallet")),
            "amount" => $this->amount,
            "charge" => $this->charge,
            "description" => $this->description,
            "created_at" => $this->created_at,
        ];
    }
}
