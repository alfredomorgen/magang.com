<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Job;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SiteController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')
            ->where('status','=',Constant::status_active)->paginate(5);
        $data = [
            'jobs' => $jobs,
        ];
        return view('home', $data);
    }
    public function indexCompany()
    {
        $user = User::with('company')
            ->where('role', '=', '1')
            ->paginate(5);
        $data = ['users' => $user];
        if (Auth::guest()) {
            return view('search_company', $data);
        } else if (Auth::user()->role == Constant::user_admin) {
            return view('admin.search_company', $data);
        } else if (Auth::user()->role == Constant::user_jobseeker) {
            return view('search_company', $data);
        }
    }

    public function loginType($user_type)
    {
        $data = ['user_types' =>$user_type];
        return view('auth.login',$data);
    }

    public function registerType($user_type)
    {
        if($user_type=='1'){
            return view('auth.register_company');
        }elseif($user_type=='2') {
            return view('auth.register_jobseeker');
        }
    }
    public function searchJob(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        $salary = $request->input('salary');
        $location = $request->input('location');
        $company = $request->input('company');

        if($company != null){
            $query = Job::leftJoin('companies','jobs.company_id','=','companies.id')
                ->join('users', 'companies.user_id', '=', 'users.id')
                ->where('jobs.name', 'LIKE', '%'.$search.'%')
                ->where('users.name', 'LIKE', '%'.$company.'%')
                ->where('jobs.status',Constant::status_active)
                ->select('*','jobs.name as job_name','jobs.location as job_location')
                ;

        }elseif($company == null){
            $query = Job::where('name', 'LIKE', '%' . $search . '%')
                ->select('*','jobs.name as job_name','jobs.location as job_location')
                ->where('status',Constant::status_active);
        }

        if($type != null){
            $query->where('type',$type);
        }
        if($salary != null){
            $query->where('salary',$salary);
        }
        if($location != null){
            $query->where('location', 'LIKE', '%' . $location . '%');
        }

        $jobs = $query->orderBy('jobs.id')->paginate(5);

        if (count($jobs) == 0) {
            return view('home')
                ->with('message', 'Job not Found')
                ->with('search', $search);
        } else {

            return view('home')
                ->with('jobs', $jobs)
                ->with('search', 'Looking for' . ' ' . $search);
        }
    }

    public function searchCompany(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'LIKE', '%' . $search . '%')
            ->Where('role', '=', '1')
            ->orderBy('id')
            ->paginate(5);
        if (count($users) == 0) {
            if(Auth::guest()){
                return view('search_company')
                    ->with('message', 'Company not Found')
                    ->with('search', $search);;
            }
            else if(Auth::user()->role == constant::user_admin)
            {
                return view('admin.search_company')
                    ->with('message', 'Company not Found')
                    ->with('search', $search);
            }
            else if (Auth::user()->role == constant::user_jobseeker)
            {
                return view('search_company')
                    ->with('message', 'Company not Found')
                    ->with('search', $search);;
            }
        } else {
            if(Auth::guest()){
                return view('search_company')
                    ->with('users', $users)
                    ->with('search', 'Looking for' . ' ' . $search);
            } else if(Auth::user()->role == constant:: user_admin) {
                return view('admin.search_company')
                    ->with('users', $users)
                    ->with('search', 'Looking for' . ' ' . $search);
            }elseif(Auth::user()->role== constant:: user_jobseeker){
                return view('search_company')
                    ->with('users', $users)
                    ->with('search', 'Looking for' . ' ' . $search);
            }
        }
    }
}
