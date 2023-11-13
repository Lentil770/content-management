<?php

namespace App\Imports;

use App\Http\Controllers\UploadController;
use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $categoryIds = UploadController::$categoryIds;
        foreach ($rows as $index=>$row) {
            Book::create([
                'author' => $row['author'],
                'title' => $row['title'],
                'subtitle' => $row['subtitle'],
                'category_id' => $categoryIds[$index]
            ]);
        }
    }
}
