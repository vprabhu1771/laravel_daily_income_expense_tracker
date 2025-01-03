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
        // In your widget or wherever you are defining the stats:
        $income = number_format($this->getPageTableQuery()->where('type', 'income')->sum('amount'), 2);
        $expense = number_format($this->getPageTableQuery()->where('type', 'expense')->sum('amount'), 2);

        return [
            Stat::make('Total Transactions', $this->getPageTableQuery()->count()),
            Stat::make('Total Income Amount', '$ ' . $income),
            Stat::make('Total Expense Amount', '$ ' . $expense),
            // Stat::make('Average time on page', '3:12'),
        ];
    }
}
