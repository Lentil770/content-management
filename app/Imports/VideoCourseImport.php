<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VideoCourseImport implements ToCollection, WithHeadingRow
{
    public $videoCourseIds = [];
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $courseId = $this->getOrCreateCourseId($row['course']);
            $this->courseIds[] = $courseId;
        }
    }

    // checks if course exists, return id if yes, else insert and return id
    public function getOrCreateCourseId($courseName)
    {
        $courseId = DB::table('courses')->where('course_name', $courseName)->first();
        if ($courseId) {
            return $courseId->id;
        } else {
            $courseId = DB::table('courses')->insertGetId([
                'course_name' => $courseName,
            ]);
            return $courseId;
        }
    }

    public function getVideoCourseIds()
    {
        return $this->courseIds;
    }
}
