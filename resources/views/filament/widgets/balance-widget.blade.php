<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <x-filament::card>
            <h2>Income: ${{ number_format($this->getBalanceData()['income'], 2) }}</h2>
            <h2>Expenses: ${{ number_format($this->getBalanceData()['expense'], 2) }}</h2>
            <h2>Balance: ${{ number_format($this->getBalanceData()['balance'], 2) }}</h2>
        </x-filament::card>

    </x-filament::section>
</x-filament-widgets::widget>
