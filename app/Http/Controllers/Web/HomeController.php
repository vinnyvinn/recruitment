<?php

namespace Boaz\Http\Controllers\Web;

use Artisan;
use DB;
use Dotenv\Dotenv;
use Illuminate\Http\Request;

use Input;
use Session;
use Settings;
use Boaz\Job;
use Boaz\Http\Controllers\Controller;
use Boaz\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
    	$jobs = Job::all();
        return view('home.index', compact('jobs'));
    }

    public function jobDetail($id)

    {
    	$job=Job::find($id);
    	if($job){
            return view('home.job-details',compact('job'));
        }else{
            return redirect('apply-job')->with([
                'message'=> 'Job Details Not found'
            ]);
        }
    }
   
}
