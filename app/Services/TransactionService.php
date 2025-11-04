<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Client;
use App\Models\Gateway;
use Illuminate\Support\Facades\DB;
use Exception;

class TransactionService
{
    /**
     * Cria uma nova transação com múltiplos produtos e calcula o valor total.
     *
     * @param array $data 
     * [
     *   'client_id' => 1, 
     *   'gateway_id' => 1, 
     *   'products' => [['product_id' => 1, 'quantity' => 2], ['product_id' => 2, 'quantity' => 1]]
     * ]
     * @return Transaction
     */
    public function createTransaction(array $data): Transaction
    {
        DB::beginTransaction();

        try {
            $totalAmount = $this->calculateTotalAmount($data['products']);
            $transaction = Transaction::create([
                'client_id' => $data['client_id'],
                'gateway_id' => $data['gateway_id'],
                'status' => 'pending', // Status inicial
                'amount' => $totalAmount,
            ]);
            $this->syncProducts($transaction, $data['products']);
            DB::commit();
            return $transaction;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function calculateTotalAmount(array $productsData): float
    {
        $total = 0;
        $productIds = collect($productsData)->pluck('product_id')->unique();
        $productsInDb = Product::whereIn('id', $productIds)->get()->keyBy('id');
        foreach ($productsData as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $product = $productsInDb->get($productId);
            if (!$product || $quantity <= 0) {
                throw new Exception("Produto inválido ou quantidade incorreta.");
            }
            $total += $product->amount * $quantity;
        }
        return $total;
    }

    private function syncProducts(Transaction $transaction, array $productsData): void
    {
        $syncData = [];
        foreach ($productsData as $item) {
            $syncData[$item['product_id']] = ['quantity' => $item['quantity']];
        }
        $transaction->products()->sync($syncData);
    }
}