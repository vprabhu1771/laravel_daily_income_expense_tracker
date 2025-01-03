<?php

namespace App\Enums;
  

enum TransactionType: string{

    case INCOME = 'INCOME';

    case EXPENSE = 'EXPENSE';

    public static function getValue(): array 
    {
      return array_column(ReportType::cases(),'value');
    }

    public static function getKeyValue(): array 
    {
      return array_column(ReportType::cases(),'value','key');
    }
}