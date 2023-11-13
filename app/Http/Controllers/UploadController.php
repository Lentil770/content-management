<?php

namespace App\Http\Controllers;

use App\Imports\CategoryImport;
use App\Imports\LocationImport;
use App\Imports\ReadingsImport;
use App\Imports\BooksImport;
use App\Imports\OrgBooksImport;
use App\Imports\VideoCategoryImport;
use App\Imports\VideoCourseImport;
use App\Imports\VideoSeriesImport;
use App\Imports\VideosImport;
use App\Models\BackupDatabase;
use App\Models\Location;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

// use OrgBooks;

class UploadController extends Controller
{
    public static $locationIds = [];
    public static $categoryIds = [];
    public static $orgBookIds = [];
    public static $videoCategoryIds = [];
    public static $videoCourseIds = [];
    public static $videoSeriesIds = [];
    public static $videoReferenceVideoIds = [];
    public static $headings = [];

    public function index($uploadType)
    {
        switch ($uploadType) {
            case 'readings':
                return view('upload.readings');
                // return $this->readings();
                break;
            case 'videos':
                return view('upload.videos');
                break;
            case 'library':
                return view('upload.library', [
                    'readyToUpload' => true,
                ]);
                break;
            default:
                return response(view('errors.404'), 404);
                break;
        }
        // return view('upload');
    }

    public function uploadReadings(Request $request)
    {
        $uploadedFile = $request->file('uploaded_file');
        $this->validateFileType($uploadedFile->getClientOriginalName());
        BackupDatabase::backup();

        $this::$headings = (new HeadingRowImport())->toArray($uploadedFile);
        $this::$headings = $this::$headings[0][0];
        $this->validateColumns('readings');

        $locationImport = new LocationImport();
        Excel::import($locationImport, $uploadedFile);
        $this::$locationIds = $locationImport->getLocationIds();
        $OrgBooksImport = new OrgBooksImport();
        Excel::import($OrgBooksImport, $uploadedFile);
        $this::$orgBookIds = $OrgBooksImport->getOrgBookIds();
        Excel::import(new ReadingsImport, $uploadedFile);
        return redirect()->route('readings.index')
            ->with('success', 'Records have Successfully been imported');
    }

    public function uploadLibrary(Request $request)
    {
        $uploadedFile = $request->file('uploaded_file');
        $this->validateFileType($uploadedFile->getClientOriginalName());
        BackupDatabase::backup();

        $this::$headings = (new HeadingRowImport())->toArray($uploadedFile);
        $this::$headings = $this::$headings[0][0];
        $this->validateColumns('library');

        $categoryImport = new CategoryImport();
        Excel::import($categoryImport, $uploadedFile);
        $this::$categoryIds = $categoryImport->getCategoryIds();
        Excel::import(new BooksImport, $uploadedFile);
        return redirect()->route('library.index')
            ->with('success', 'Library Books have Successfully been imported');
    }

    public function uploadVideos(Request $request)
    {
        $uploadedFile = $request->file('uploaded_file');
        $this->validateFileType($uploadedFile->getClientOriginalName());
        BackupDatabase::backup();
        $this::$headings = (new HeadingRowImport())->toArray($uploadedFile);
        $this::$headings = $this::$headings[0][0];
        $this->validateColumns('videos');

        $videoCategoryIds = new VideoCategoryImport();
        Excel::import($videoCategoryIds, $uploadedFile);
        $this::$videoCategoryIds = $videoCategoryIds->getVideoCategoryIds();

        if (in_array('course', $this::$headings)) {
            $videoCourseIds = new VideoCourseImport();
            Excel::import($videoCourseIds, $uploadedFile);
            $this::$videoCourseIds = $videoCourseIds->getVideoCourseIds();
        }

        if (in_array('series', $this::$headings)) {
            $videoSeriesIds = new VideoSeriesImport();
            Excel::import($videoSeriesIds, $uploadedFile);
            $this::$videoSeriesIds = $videoSeriesIds->getVideoSeriesIds();
        }

        Excel::import(new VideosImport, $uploadedFile);
        return redirect()->route('videos.index')
            ->with('success', 'Videos have Successfully been imported');
    }

    public function validateFileType($fileName)
    {
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($ext != 'xlsx') {
            throw ValidationException::withMessages(['Error' => 'Wrong File Type']);
        } else return true;
    }

    public function validateColumns($category)
    {

        $headingsArray = [];
        switch ($category) {
            case 'videos':
                $headingsArray = [
                    'category',
                    'title',
                    'link',
                ];
                break;
            case 'readings':
                $headingsArray = [
                    'locationa',
                    'locationb',
                    'locationc',
                    'english',
                    'hebrew',
                    'sourceline',
                ];
                break;
            case 'library':
                $headingsArray = [
                    'author',
                    'title',
                    'category',
                    'subtitle',
                ];
                break;

            default:
        }

        $errors = [];
        foreach ($headingsArray as $heading) {
            if (!in_array($heading, $this::$headings)) {
                $errors[$heading] = "Missing or wrong header: " . $heading;
            }
        }
        if (count($errors) > 0) {
            throw ValidationException::withMessages($errors);
        }
        return true;
    }
}
