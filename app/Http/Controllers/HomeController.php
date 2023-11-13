<?php

namespace App\Http\Controllers;

use App\Models\BackupDatabase;
use App\Models\Location;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    

    public function index()
    {
        return view('home.index');
    }


    public function backupdb()
    {
        BackupDatabase::backup();
    }
}
