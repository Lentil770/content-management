<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VideoCategoryImport implements ToCollection, WithHeadingRow
{
    public $categoryIds = [];
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // if ($rows[0] == $row) {continue;}
            $categoryId = $this->getOrCreateCategoryId($row['category']);
            $this->categoryIds[] = $categoryId;
        }
    }

    // build function to check if category exists, return id if yes, else insert and return id
    public function getOrCreateCategoryId($categoryName)
    {
        $categoryId = DB::table('categories')->where('category_name', $categoryName)->first();
        if ($categoryId) {
            return $categoryId->id;
        } else {
            $categoryId = DB::table('categories')->insertGetId([
                'category_name' => $categoryName,
            ]);
            return $categoryId;
        }
    }

    public function getVideoCategoryIds()
    {
        return $this->categoryIds;
    }
}
