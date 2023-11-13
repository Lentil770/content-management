<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VideoSeriesImport implements ToCollection, WithHeadingRow
{
    public $seriesIds = [];
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $seriesId = $this->getOrCreateSeriesId($row['series']);
            $this->seriesIds[] = $seriesId;
        }
    }

    // build function to check if category exists, return id if yes, else insert and return id

    public function getOrCreateSeriesId($seriesName)
    {
        $seriesId = DB::table('series')->where('series_name', $seriesName)->first();

        if ($seriesId) {
            return $seriesId->id;
        } else {
            $seriesId = DB::table('series')->insertGetId([
                'series_name' => $seriesName,
            ]);
            return $seriesId;
        }
    }




    public function getVideoSeriesIds()
    {
        return $this->seriesIds;
    }
}
