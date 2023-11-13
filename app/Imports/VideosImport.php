<?php

namespace App\Imports;

use App\Http\Controllers\UploadController;
use App\Models\Video;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VideosImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $categoryIds = UploadController::$videoCategoryIds;
        $courseIds = UploadController::$videoCourseIds;
        $seriesIds = UploadController::$videoSeriesIds;
        foreach ($rows as $index=>$row) {
            echo $index . ' - ' . $row;
            Video::create([
                'category_id' => $categoryIds[$index],
                'title' => $row['title'],
                'video_url' => $row['link'],
                'description' => in_array('description', UploadController::$headings) ? $row['description'] : $row['overview'],
                'series_id' => in_array('series', UploadController::$headings) ? $seriesIds[$index] : null,
                'course_id' => in_array('course', UploadController::$headings) ? $courseIds[$index] : null,
                'class_number' => in_array('lesson', UploadController::$headings) ? $row['lesson'] : null,
                'tags' => in_array('tags', UploadController::$headings) ? $row['tags'] : null,
            ]);
        }
    }
}
