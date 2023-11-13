<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OrgBooksImport implements ToCollection
{
    public $orgBookIds = [];
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($rows[0] == $row) {
                continue;
            }
            $bookId = $this->getOrCreateBookId($row[8]);
            $this->orgBookIds[] = $bookId;
        }
    }

    // build function to check if book exists, return id if yes, else insert and return id

    public function getOrCreateBookId($bookName)
    {
        $bookId = DB::table('org_books')->where('org_book_name', $bookName)->first();
        if ($bookId) {
            return $bookId->id;
        } else {
            $bookId = DB::table('org_books')->insertGetId([
                'org_book_name' => $bookName,
            ]);
            return $bookId;
        }
    }


    public function getOrgBookIds()
    {
        return $this->orgBookIds;
    }
}
