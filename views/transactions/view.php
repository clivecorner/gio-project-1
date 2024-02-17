<!DOCTYPE html>
<html>
    <head>
        <title>Transactions view</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->params['transactions'] as $transaction) {?>
                    <tr>
                        <td><?php echo $this->convertDate($transaction['the_date']); ?></td>
                        <td><?=$transaction['the_check']?></td>
                        <td><?=$transaction['the_description']?></td>
                        <?php echo $this->formatAmount($transaction['the_amount']); ?>
                    </tr>
                <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?php echo $this->params['totalIncome']; ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?php echo $this->params['totalExpense']; ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?php echo $this->params['netTotal']; ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
