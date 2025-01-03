<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

use App\Enums\TransactionType;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
 
    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'Income' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', TransactionType::INCOME)),
            'Expense' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', TransactionType::EXPENSE)),
        ];
    }
}
