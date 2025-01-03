<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Generate today's transactions report.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateTodayReport()
    {
        // Fetch today's transactions
        $today = now()->format('Y-m-d');
        $transactions = Transaction::whereDate('date', $today)->get();

        // Calculate totals
        $totalIncome = $transactions->where('type', 'INCOME')->sum('amount');
        $totalExpense = $transactions->where('type', 'EXPENSE')->sum('amount');

        // Generate PDF view
        $pdf = Pdf::loadView('pdf.reports', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'date' => $today,
        ]);

        return $pdf->stream('today_report.pdf', ['Attachment' => false]);
    }

    /**
     * Download today's transactions report.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadTodayReport()
    {
        // Fetch today's transactions
        $today = now()->format('Y-m-d');
        $transactions = Transaction::whereDate('date', $today)->get();

        // Calculate totals
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');

        // Generate PDF view
        $pdf = Pdf::loadView('pdf.reports', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'date' => $today,
        ]);

        return $pdf->download('today_report.pdf'); // Download the file
    }
}
