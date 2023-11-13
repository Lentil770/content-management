<?php

namespace App\Imports;

use App\Http\Controllers\UploadController;
use App\Models\Reading;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReadingsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $locationIds = UploadController::$locationIds;
        $orgBookIds = UploadController::$orgBookIds;
        foreach ($rows as $index => $row) {
            Reading::create([
                'location_id' => $locationIds[$index],
                'reading_text' => $row['hebrew'],
                'translation' => $row['english'],
                'english_location_full' => $row['sourceline'],
                'hebrew_location_full' => $row['hebrewsource'],
                'org_book_id' => $orgBookIds[$index],
                'org_book_page' => $row['orgbookpage'],
            ]);
        }
    }
}
