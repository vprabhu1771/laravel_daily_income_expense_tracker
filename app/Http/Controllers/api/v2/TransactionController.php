<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Enums\TransactionType;

use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * List transactions (income, expense, or all).
     */
    public function index(Request $request)
    {
        // Filter by type if provided, otherwise return all
        $type = $request->query('type', 'all');
        $transactions = Transaction::when($type !== 'all', function ($query) use ($type) {
            $query->where('type', $type);
        })->get();

        return response()->json([
            // 'success' => true,
            'data' => $transactions,
        ]);
    }

    /**
     * Store a new transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:INCOME,EXPENSE',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $transaction = Transaction::create([
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'description' => $validated['description'] ?? null,
            'date' => $validated['date'],
        ]);

        return response()->json([
            'success' => true,
            'data' => $transaction,
        ], 201);
    }

    /**
     * Get a single transaction by ID.
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction,
        ]);
    }

    /**
     * Update an existing transaction.
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.',
            ], 404);
        }

        $validated = $request->validate([
            'type' => 'nullable|in:INCOME,EXPENSE',
            'amount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        // Update only fields provided in the request
        $transaction->update(array_filter($validated));

        return response()->json([
            'success' => true,
            'data' => $transaction,
        ]);
    }
}
