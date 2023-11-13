<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BackupDatabase extends Model
{
    public static function backup()
    {
        /*
        Needed in SQL File:

        SET GLOBAL sql_mode = '';
        SET SESSION sql_mode = '';
        */
        $get_all_table_query = "SHOW TABLES";
        $result = DB::select(DB::raw($get_all_table_query));

        $tables = [
            'books',
            'locations',
            'readings',
            'book_categories',
            'org_books'
        ];

        $structure = '';
        $data = '';
        foreach ($tables as $table) {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";

            $show_table_result = DB::select(DB::raw($show_table_query));

            foreach ($show_table_result as $show_table_row) {
                $show_table_row = (array)$show_table_row;
                $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table;
            $records = DB::select(DB::raw($select_query));

            foreach ($records as $record) {
                $record = (array)$record;
                $table_column_array = array_keys($record);
                foreach ($table_column_array as $key => $name) {
                    $table_column_array[$key] = '`' . $table_column_array[$key] . '`';
                }

                $table_value_array = array_values($record);
                $data .= "\nINSERT INTO $table (";

                $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";

                foreach ($table_value_array as $key => $record_column)
                    $table_value_array[$key] = addslashes($record_column);

                $data .= "('" . implode("','", $table_value_array) . "');\n";
            }
        }
        $file_name = __DIR__ . '/../../database/database_backup_on_' . date('y_m_d') . '.sql';
        $file_handle = fopen($file_name, 'w + ');

        $output = $structure . $data;
        fwrite($file_handle, $output);
        fclose($file_handle);
        echo "DB backup ready";
    }
}
