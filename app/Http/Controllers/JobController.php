<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Job;
use Illuminate\Http\Request;

use App\Http\Requests;

class JobController extends Controller
{
    public function index($id){
        $job = Job::findOrFail($id);
        if($job->status == Constant::status_active){
            $data = ['job' => $job];
            return view('job.job_detail', $data);
        } else {
            abort(404);
        }
    }

    public function search_job()
    {
        $job = Job::select('*')->paginate(3);

        $data = ['jobs' => $job];

        return view('job.search_job',$data);
    }
}
