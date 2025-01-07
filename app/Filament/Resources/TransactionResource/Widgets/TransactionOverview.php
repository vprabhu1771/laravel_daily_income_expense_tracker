<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Filament\Resources\TransactionResource\Pages\ListTransactions;

use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class TransactionOverview extends BaseWidget
{

    use InteractsWithPageTable;
    use ExposesTableToWidgets;

    protected function getTablePage(): string
    {
        return ListTransactions::class;
    }

    protected function getStats(): array
    {
        // Fetch the raw income and expense sums
        $income = $this->getPageTableQuery()->where('type', 'income')->sum('amount');
        $expense = $this->getPageTableQuery()->where('type', 'expense')->sum('amount');

        // Calculate the balance using raw values
        $balance = $income - $expense;

        // Format income, expense, and balance for display
        $formattedIncome = number_format($income, 2);
        $formattedExpense = number_format($expense, 2);
        $formattedBalance = number_format($balance, 2);

        return [
            Stat::make('Total Transactions', $this->getPageTableQuery()->count()),
            Stat::make('Total Income Amount', '$ ' . $formattedIncome),
            Stat::make('Total Expense Amount', '$ ' . $formattedExpense),
            Stat::make('Balance Amount', '$ ' . $formattedBalance),
        ];
    }

}
