<!DOCTYPE html>
<html>
<head>
    <title>Today's Transactions Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Transactions Report for {{ $date }}</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ $transaction->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No transactions found for today.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3">Total Income</td>
                <td colspan="2">{{ number_format($totalIncome, 2) }}</td>
            </tr>
            <tr class="total">
                <td colspan="3">Total Expense</td>
                <td colspan="2">{{ number_format($totalExpense, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
