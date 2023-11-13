<?php

namespace App\Http\Controllers;

use App\Models\BackupDatabase;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReadingsIndexController extends Controller
{
    public function __construct()
    {
        $this->locationLevels = [
            'A' => null,
            'B' => null,
            'C' => null,
            'D' => null,
            'currentLevel' => null,
            'nextLevel' => 'A',
        ];

        $allLocations = DB::table('locations')->select('location_a')->distinct()->get();
        $this->allLocations = collect($allLocations)->map(function ($item) {
            $item->location_url = $this->formatLocationUrl($item);
            return $item;
        });
        $allLocationsFull = DB::table('locations')->select('id', 'location_a', 'location_b', 'location_c', 'location_d')->distinct()->get();
        $this->allLocationsFull = collect($allLocationsFull);
        $allOrgBooks = DB::table('org_books')->select('id', 'org_book_name')->distinct()->get();
        $this->allOrgBooks = collect($allOrgBooks);
    }

    public function index(Request $request)
    {
        /*
        search - not sending any readings
        */
        $this->searchTerm = $request->search ?: false;

        $allLocations = $this->allLocations;
        $this->setLocationLevels($request);
        $locations = $this->fetchLocations();
        $locations = $this->setLocationDetails($locations);
        $readings = $this->fetchReadings($request);
        $allLocationsFull = $this->allLocationsFull;
        $allOrgBooks = $this->allOrgBooks;
        $currentLocation = $this->locationLevels;

        return view('readings.index', compact('allLocations', 'locations', 'readings', 'allLocationsFull', 'allOrgBooks', 'currentLocation'));
    }


    private function fetchLocations()
    {
        $query = DB::table('locations');

        if ($this->searchTerm) {
            $query->where('location_a', 'LIKE', "%{$this->searchTerm}%")->orWhere('location_b', 'LIKE', "%{$this->searchTerm}%")->orWhere('location_c', 'LIKE', "%{$this->searchTerm}%")->orWhere('location_d', 'LIKE', "%{$this->searchTerm}%");
        } else {
            if ($this->locationLevels['D'] != null) {
                return [];
            }
            if ($this->locationLevels['C'] != null) {
                $query->addselect('location_d')->where('location_c', $this->locationLevels['C'])->whereNotNull('location_d');
            }
            if ($this->locationLevels['B'] != null) {
                $query->addselect('location_c')->where('location_b', $this->locationLevels['B'])->whereNotNull('location_c');
            }
            if ($this->locationLevels['A'] != null) {
                $query->addselect('location_a', 'location_b')->where('location_a', $this->locationLevels['A'])->whereNotNull('location_b');
            } else {
                return $this->allLocations;
            }
        }

        return $query->distinct()->get();
    }

    private function setLocationDetails($locations)
    {
        $location_level_for_name = 'location_' . strtolower($this->locationLevels['nextLevel']);

        for ($i = 0; $i < count($locations); $i++) {
            $locations[$i]->location_url = $this->formatLocationUrl($locations[$i]);
            $locations[$i]->location_name = $locations[$i]->$location_level_for_name;
        }
        return $locations;
    }

    private function formatLocationUrl($locationObject)
    {

        $url = '/readings';
        if (isset($locationObject->location_a)) {
            $url .= '?locationa=' . urlencode($locationObject->location_a);
        }
        if (isset($locationObject->location_b)) {
            $url .= '&locationb=' . urlencode($locationObject->location_b);
        }
        if (isset($locationObject->location_c)) {
            $url .= '&locationc=' . urlencode($locationObject->location_c);
        }
        if (isset($locationObject->location_d)) {
            $url .= '&locationd=' . urlencode($locationObject->location_d);
        }
        return $url;
    }
    // set location levels func
    private function setLocationLevels(Request $request)
    {
        if ($request->has('locationa')) {
            $this->locationLevels['A'] = $request->locationa ?? null;
            $this->locationLevels['currentLevel'] = 'A';
            $this->locationLevels['nextLevel'] = 'B';
        }
        if ($request->has('locationb')) {
            $this->locationLevels['B'] = $request->locationb ?? null;
            $this->locationLevels['currentLevel'] = 'B';
            $this->locationLevels['nextLevel'] = 'C';
        }
        if ($request->has('locationc')) {
            $this->locationLevels['C'] = $request->locationc ?? null;
            $this->locationLevels['currentLevel'] = 'C';
            $this->locationLevels['nextLevel'] = 'D';
        }
        if ($request->has('locationd')) {
            $this->locationLevels['D'] = $request->locationd ?? null;
            $this->locationLevels['currentLevel'] = 'D';
            $this->locationLevels['nextLevel'] = null;
        }
        if ($this->searchTerm) {
            $this->locationLevels['A'] = null;
            $this->locationLevels['B'] = null;
            $this->locationLevels['C'] = null;
            $this->locationLevels['D'] = null;
            $this->locationLevels['currentLevel'] = null;
            $this->locationLevels['nextLevel'] = 'A';
        }
    }

    private function fetchReadings(Request $request)
    {
        $query = DB::table('readings');

        if ($this->searchTerm) {
            $query->where('reading_text', 'LIKE', "%{$this->searchTerm}%")->orWhere('translation', 'LIKE', "%{$this->searchTerm}%");
        }

        $query->leftJoin('locations', 'readings.location_id', '=', 'locations.id')->leftJoin('org_books', 'readings.org_book_id', '=', 'org_books.id')->select('readings.*', 'locations.*', 'org_books.*');

        // added where nulls so only current LEvel readings get fetched.
        $query = ($request->locationa) ? $query->where('location_a', $request->locationa) : $query;
        $query = ($request->locationb) ? $query->where('location_b', $request->locationb) : $query->whereNull('location_b');
        $query = ($request->locationc) ? $query->where('location_c', $request->locationc)
            : $query->whereNull('location_c');
        $query = ($request->locationd) ? $query->where('location_d', $request->locationd) : $query->whereNull('location_d');
        $readings = $query->paginate(15);
        return $readings;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reading  $Reading
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        BackupDatabase::backup();
        $request->validate([
            'reading_text' => 'required',
            'org_book_page' => 'required',
        ]);
        $reading = Reading::find($id);
        $reading->location_id = $request->location_id;
        $reading->reading_text = $request->reading_text;
        $reading->translation = $request->translation;
        $reading->english_location_full = $request->english_location_full;
        $reading->hebrew_location_full = $request->hebrew_location_full;
        $reading->org_book_id = $request->org_book_id;
        $reading->org_book_page = $request->org_book_page;
        $reading->save();
        return redirect()->route('readings.index')
            ->with('success', 'Updated Successfully' . $reading->reading_text);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reading  $reading
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reading $reading, $id)
    {
        BackupDatabase::backup();
        $reading = Reading::find($id);
        $reading->delete();
        return redirect()->route('readings.index')
            ->with('success', 'Reading Deleted Successfully' . $reading->reading_text);
    }


    public function store(Request $request)
    {
        $request->validate([
            'reading_text' => 'required',
            'org_book_page' => 'required',
        ]);
        $reading = new Reading;
        $reading->location_id = $request->location_id;
        $reading->reading_text = $request->reading_text;
        $reading->translation = $request->translation;
        $reading->english_location_full = $request->english_location_full;
        $reading->hebrew_location_full = $request->hebrew_location_full; // removed from form
        $reading->org_book_id = $request->org_book_id;
        $reading->org_book_page = $request->org_book_page;
        $reading->save();
        return redirect()->route('readings.index')
            ->with('success', 'Reading Created Successfully' . $reading->reading_text);
    }
}
