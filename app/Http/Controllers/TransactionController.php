<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Transaction::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type'   => 'required|in:debit,credit',
        ]);

        $transaction = $request->user()->transactions()->create($validated);

        return response()->json($transaction, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $hash)
    {
        $transaction = Transaction::where('hash', $hash)->firstOrFail();

        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $hash)
    {
        // Buscamos pelo hash único conforme solicitado
        $transaction = Transaction::where('hash', $hash)->firstOrFail();

        $validated = $request->validate([
            'amount' => 'numeric|min:0.01',
            'type'   => 'in:debit,credit',
        ]);

        /** 
         * Análise Estratégica:
         * Usamos o fill() apenas com os dados validados. 
         * O hash permanece intocado no objeto.
         */
        $transaction->update($validated);

        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $hash)
    {
        $transaction = Transaction::where('hash', $hash)->firstOrFail();
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully'], 200);
    }
}
