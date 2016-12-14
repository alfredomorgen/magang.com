<?php

namespace App\Http\Controllers;

use App\Company;
use App\Jobseeker;
use App\Job;
use App\User;
use App\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class SearchController extends Controller
{
    

    public function indexJobseeker()
    {
        $user = User::with('jobseeker')
            ->where('role', '=', '2')
            ->paginate(5);
        $data = ['users' => $user];
        if(Auth::user()->role == constant::user_admin)
        {
            return view('admin.search_jobseeker', $data);
        }
        else if (Auth::user()->role == constant::user_company)
        {
            return view('company.search_jobseeker', $data);
        }

    }

    public function indexJob()
    {
        $job = Job::select('*')
            ->paginate(5);
        $data = ['jobs' => $job];
        return view('admin.search_job', $data);
    }

    public function searchJob($search)
    {
        $jobs = Job::where('name', 'LIKE', '%' . $search . '%')
            ->orderBy('id')
            ->paginate(5);
        if (count($jobs) == 0) {
            return view('admin.search_job')
                ->with('message', 'Job not Found')
                ->with('search', $search);
        } else {
            return view('admin.search_job')
                ->with('jobs', $jobs)
                ->with('search', 'Looking for' . ' ' . $search);
        }
    }

    

    public function searchJobseeker($search)
    {

        $users = User::where('name', 'LIKE', '%' . $search . '%')
            ->Where('role', '=', '2')
            ->orderBy('id')
            ->paginate(5);
        if (count($users) == 0) {
            if (Auth::user()->role == constant::user_admin) {
                return view('admin.search_jobseeker')
                    ->with('message', 'Jobseeker not Found')
                    ->with('search', $search);
            } else if (Auth::user()->role == constant::user_company) {
                return view('company.search_jobseeker')
                    ->with('message', 'Jobseeker not Found')
                    ->with('search', $search);
            }
        } else {
            if (Auth::user()->role == constant::user_admin) {
                return view('admin.search_jobseeker')
                    ->with('users', $users)
                    ->with('search', 'Looking for' . ' ' . $search);
            } else if (Auth::user()->role == constant::user_company) {
                return view('company.search_jobseeker')
                    ->with('users', $users)
                    ->with('search', 'Looking for' . ' ' . $search);
            }

        }
    }
}
