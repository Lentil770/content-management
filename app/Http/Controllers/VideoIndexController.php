<?php

namespace App\Http\Controllers;

use App\Models\BackupDatabase;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoIndexController extends Controller
{
    /**
     * Params:
     * search - optional (string)
     * category - optional (number of id || 'All')
     * course - optional (number of id || 'All')
     * series - optional (number of id || 'All') 
     */
    public function index(Request $request)
    {
        $this->searchTerm = $request->search ? $request->search : false;
        $category_id = $request->category ? $request->category : null; // get id from param.
        $course_id = $request->course ? $request->course : null; // get id from param.
        $series_id = $request->series ? $request->series : null; // get id from param.
        // $categorySelected = $category_id && $category_id != 'All';
        if ($request->include_filters) {
            $category_id = null;
            $course_id = null;
            $series_id = null;
        }
        $allCategories = Category::all();

        $videosToReturn = $category_id ? DB::table('videos')->where('category_id', $category_id) : DB::table('videos')->limit(15);
        
        
        $allCourses = DB::table('courses')->get();
        $allSeries = DB::table('series')->get();

        $coursesToReturn = $category_id ? $allCourses->where('category_id',$category_id) : $allCourses;
        $seriesToReturn = $category_id ? $allSeries->where('category_id',$category_id) : $allSeries;

        // need to add filter by chosen series / vourse WITHIN / WITHOUT category.
        $videosToReturn = $course_id ? $videosToReturn->where('course_id', $course_id) : $videosToReturn;
        $videosToReturn = $series_id ? $videosToReturn->where('series_id', $series_id) : $videosToReturn;

        // filter videos by search
        if ($this->searchTerm) {
            $videosToReturn = $request->include_filters ? $videosToReturn : DB::table('videos');
            $videosToReturn = $videosToReturn->where(function($query) {
                $query->where('title', 'LIKE', "%{$this->searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$this->searchTerm}%")
                ->orWhere('video_url', 'LIKE', "%{$this->searchTerm}%")->orWhere('tags', 'LIKE', "%{$this->searchTerm}%");
            });
        }
        

        $videosToReturn = $videosToReturn->paginate(15);

        $currentValues = [
            'category'=>$category_id ? $category_id : null,
            'course'=>$course_id ? $course_id : null,
            'series'=>$series_id ? $series_id : null,
            'search_term'=>$this->searchTerm ? $this->searchTerm : null,
            'include_filters'=>$request->include_filters ? true : false
        ];

        return view('video.index', [
            'categories'=>$allCategories,
            'courses'=>$coursesToReturn,
            'series'=>$seriesToReturn,
            'videos'=>$videosToReturn,
            'currentValues'=>$currentValues
        ]
        );
        // return [$allCategories, $coursesToReturn, $seriesToReturn, $videosToReturn];
    }

    

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Video  $video
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        BackupDatabase::backup();
        $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);
        $video = Video::find($id);
        $video->title = $request->title;
        $video->video_url = $request->url;
        $video->description = $request->description;
        $video->category_id = $request->category ? $request->category : null;
        $video->series_id = $request->series ? $request->series : null;
        $video->course_id = $request->course ? $request->course : null;
        $video->class_number = $request->class_number;
        $video->tags = $request->tags;
        
        $video->save();
        return redirect()->route('videos.index')
        ->with('success', 'Updated Successfully ' . $video->title . ' - ' . $video->video_url);
    }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Video  $video
    * @return \Illuminate\Http\Response
    */
    public function destroy( $id )
    {
        BackupDatabase::backup();
        $video = Video::find($id);
        $video->delete();
        return redirect()->route('videos.index')
        ->with('success','Video Deleted Successfully ' . $video->title);
    }

    
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);
        $video = new Video;
        $video->title = $request->title;
        $video->video_url = $request->url;
        $video->description = $request->description;
        $video->category_id = $request->category ? $request->category : null;
        $video->series_id = $request->series ? $request->series : null;
        $video->course_id = $request->course ? $request->course : null;
        $video->class_number = $request->class_number;
        $video->tags = $request->tags;

        $video->save();
        return redirect()->route('videos.index')
        ->with('success','Video Created Successfully ' . $video->title . ' - ' . $video->video_url);
    }

}
 