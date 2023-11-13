<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class LocationImport implements ToCollection
{
    public $locationIds = [];
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($rows[0] == $row) {continue;}
            $locationId = $this->getOrCreateLocationId($row);
            $this->locationIds[] = $locationId;
        }
    }

    public function getOrCreateLocationId($location)
    {
        $existingLocation = DB::table('locations')->where('location_a', $location[0])->where('location_b', $location[1])->where('location_c', $location[2])->where('location_d', $location[3])->first();
        
        if ($existingLocation) {
            return $existingLocation->id;
        } else {
            $locationId = DB::table('locations')->insertGetId([
                'location_a' => $location[0],
                'location_b' => $location[1],
                'location_c' => $location[2],
                'location_d' => $location[3],
            ]);
        return $locationId;
        }
    }

    public function getLocationIds()
    {
        return $this->locationIds;
    }
}
