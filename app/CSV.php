<?php

declare (strict_types = 1);

namespace App;

class CSV
{

    public static function checkCSVFile($filename)
    {
        try {
            // Check if the file exists
            if (!file_exists($filename)) {
                return false;
            }

            // Open the file
            $file = fopen($filename, 'r');

            // Check if the file could be opened
            if (!$file) {
                return false;
            }

            // Read the first line of the file
            $header = fgetcsv($file);

            // Check if the header is empty or not an array
            if (empty($header) || !is_array($header)) {
                fclose($file);
                return false;
            }

            // Read the remaining lines of the file
            while (($data = fgetcsv($file)) !== false) {
                // Check if the number of columns in each row matches the number of columns in the header
                if (count($data) !== count($header)) {
                    fclose($file);
                    return false;
                }
            }

            // Close the file
            fclose($file);

            // Return true if all checks pass
            return true;
        } catch (\Exception $e) {

            echo 'There was a problem parsing the CSV file';
        }

    }
}
