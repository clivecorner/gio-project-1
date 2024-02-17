<?php

declare (strict_types = 1);

namespace App\Controllers;

use App\CSV;
use App\Models\Transaction;
use App\View;
use App\ViewHelper;

class TransactionController
{
    use ViewHelper;

    public function index(): View
    {
        return View::make('transactions/index');
    }

    public function upload()
    {

        if (isset($_FILES['transactions']['tmp_name'])) {
            foreach ($_FILES["transactions"]["tmp_name"] as $fileName) {
                //$fileName = $_FILES["transactions"]["tmp_name"][0];

                if (CSV::checkCSVFile($fileName)) {

                    (new Transaction())->write($fileName);
                } else {
                    echo "There was a problem with the CSV file";
                    exit;
                }
            }

        }

        header('Location: /transactions/view');
    }

    public function download()
    {
        return (new Transaction())->read();
    }

    public function view() //: View
    {

        $transactions = $this->download();

        $totalIncome = $this->totalIncome($transactions);
        $totalExpense = $this->totalExpense($transactions);
        $netTotal = $totalIncome + $totalExpense;

        $totalIncome = '$' . $totalIncome;
        $totalExpense = '-$' . str_replace(['$', '-'], '', (string) $totalExpense);
        $netTotal = $netTotal > 0 ? '$' . $netTotal : '-$' . str_replace('-', '', (string) $netTotal);

        return View::make('transactions/view', [
            'transactions' => $transactions,
            'totalExpense' => $totalExpense,
            'totalIncome' => $totalIncome,
            'netTotal' => $netTotal,
        ]);

    }

}
