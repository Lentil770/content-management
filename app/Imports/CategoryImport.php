<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class CategoryImport implements ToCollection
{
    public $categoryIds = [];
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($rows[0] == $row) {continue;}
            $categoryId = $this->getOrCreateCategoryId($row[3]);
            $this->categoryIds[] = $categoryId;
        }
    }
    // build function to check if category exists, return id if yes, else insert and return id
    public function getOrCreateCategoryId($categoryName)
    {
        $categoryId = DB::table('book_categories')->where('category_name', $categoryName)->first();
        if ($categoryId) {
            return $categoryId->id;
        } else {
            $categoryId = DB::table('book_categories')->insertGetId([
                'category_name' => $categoryName,
            ]);
            return $categoryId;
        }
    }




    public function getCategoryIds()
    {
        return $this->categoryIds;
    }
}
