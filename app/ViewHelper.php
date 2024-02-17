<?php

declare (strict_types = 1);

namespace App;

trait ViewHelper
{
    public function convertDate(string $date)
    {
        list($month, $day, $year) = explode("/", $date);

        return date('M d, Y', mktime(0, 0, 0, (int) $month, (int) $day, (int) $year));

    }
    public function formatAmount(string $amount)
    {
        $amount = (float) str_replace(['$', ','], '', $amount);
        if ($amount > 0) {
            return '<td style="color:green">' . '$' . $amount . '</td>';
        } else if ($amount < 0) {
            return '<td style="color:red">' . str_replace('-', '-$', (string) $amount) . '</td>';
        } else if ($amount == 0) {
            return '<td>' . $amount . '</td>';
        }
    }

    public function totalExpense(array $transactions): float
    {
        $totalExpense = 0;
        foreach ($transactions as $transaction) {
            if (str_contains($transaction['the_amount'], '-')) {
                $expense = (float) str_replace(['$', ','], '', $transaction['the_amount']);
                $totalExpense += $expense;
            }

        }
        return $totalExpense;
    }

    public function totalIncome(array $transactions)
    {
        $totalIncome = 0;
        foreach ($transactions as $transaction) {
            if (!str_contains($transaction['the_amount'], '-')) {
                $income = (float) str_replace(['$', ','], '', $transaction['the_amount']);
                $totalIncome += $income;
            }

        }
        return $totalIncome;
    }

}
