<?php
namespace App\Models;

use App\Model;

class Transaction extends Model
{
    public function write(string $fileName)
    {
        $file = fopen($fileName, "r");

        fgetcsv($file);

        $this->db->beginTransaction();
        while (($getData = fgetcsv($file, 10000, ",")) !== false) {

            try {

                $stmt = $this->db->prepare('INSERT INTO transactions (the_date,the_check,the_description,the_amount)
        VALUES(?,?,?,?)'
                );

                //$stmt->execute([$getData[0], $getData[1], $getData[2], str_replace(['$', ','], '', $getData[3]) * 100]);
                $stmt->execute([$getData[0], $getData[1], $getData[2], $getData[3]]);

            } catch (\PDOException $e) {
                if ($this->db->inTransaction()) {
                    $this->db->rollBack();
                }

                echo 'There was a problem writing the transaction to db';
                exit;
            }

        }
        if ($this->db->inTransaction()) {
            $this->db->commit();
        }
        fclose($file);

    }

/**
 * Function to read a MySQL database using PDO and store the results in a multi-dimensional array.
 * @param string $table    The name of the table to read from.
 * @return array|bool The multi-dimensionalt array containing the database records, or false on failure.
 */
    public function read()
    {
        try {

            // Prepare the SQL query to fetch all records from the specified table
            $query = "SELECT * FROM  transactions";
            $statement = $this->db->prepare($query);

            // Execute the query
            $statement->execute();

            // Fetch all records as an associative array
            $records = $statement->fetchAll();

            // Return the multi-dimensional array of records
            return $records;
        } catch (\PDOException $e) {
            // Handle any errors that occurred during the database operation
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

// // Usage demonstration of the readDatabase function

// // Example usage
// $host = "localhost";
// $database = "mydatabase";
// $username = "myusername";
// $password = "mypassword";
// $table = "mytable";

// $records = readDatabase($host, $database, $username, $password, $table);

// if ($records) {
//     // Print the records
//     foreach ($records as $record) {
//         echo "ID: " . $record['id'] . ", Name: " . $record['name'] . ", Age: " . $record['age'] . "\n";
//     }
// } else {
//     echo "Failed to read database.";
// }

// }

}
