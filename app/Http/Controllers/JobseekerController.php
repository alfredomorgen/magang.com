<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Company;
use App\Constant;
use App\Http\Requests\JobseekerRequest;
use App\Job;
use App\Message;
use App\Notification;
use App\Report;
use App\Transaction;
use App\User;


use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;


class JobseekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('jobseeker', ['except' => [
            'index',
        ]]);
    }

    public function index($user_id){
        $user = User::findOrFail($user_id);
        if($user->role == Constant::user_jobseeker){
            if(Auth::guest()){
                return redirect('/');
            } else if(Auth::user()->role == Constant::user_jobseeker && Auth::user()->id != $user->id){
                return redirect('/');
            }

            $data = ['user' => $user];
            return view('jobseeker.profile', $data);
        } else {
            return redirect('/');
        }
    }

    public function edit($user_id){
        $user = User::find($user_id);
        if($user != null){
            $data = ['user' => $user];
            return view('jobseeker.profile_edit', $data);
        } else {
            return redirect('/');
        }
    }

    public function update($user_id, JobseekerRequest $request){
        $user = User::find($user_id);
        if($user != null){
            $user->phone = $request->get('phone');
            $user->description = $request->get('description');

            if($request->has('password')){
                $user->password = bcrypt($request->get('password'));
            }

            if($request->hasFile('photo')){
                $photo = $request->file('photo');
                $photo_name = md5(uniqid()).'.'.$photo->getClientOriginalExtension();
                $photo->move(public_path().'/images/', $photo_name);
                $user->photo = $photo_name;
            }

            if($request->hasFile('resume')){
                $resume = $request->file('resume');
                $resume_name = md5(uniqid()).'.'.$resume->getClientOriginalExtension();
                $resume->move(public_path().'/uploads/', $resume_name);
                $user->jobseeker->resume = $resume_name;

                $user->jobseeker->save();
            }

            $user->save();
            return redirect()->route('jobseeker.index', $user_id);
        } else {
            return redirect('/');
        }
    }

    public function apply($job_id)
    {
        $message = "";
        $transaction = null;
        $isTransactionExist = Transaction::where('job_id', '=', $job_id)
            ->where('jobseeker_id', '=', Auth::user()->jobseeker->id)
            ->first();

        if($isTransactionExist == null){
            $transaction = Transaction::create([
                'job_id' => $job_id,
                'jobseeker_id' => Auth::user()->jobseeker->id,
            ]);

            if($transaction == null){
                $message = "Failed to apply job...";
            } else {
                $message = "Job successfully applied!";
            }
        } else {
            $message = "You have already applied...";
        }

        $data = ['message' => $message];
        return redirect()->route('job.index', $job_id)->with($data);
    }

    public function applied_jobs()
    {
        $transactions = Transaction::where('jobseeker_id', Auth::user()->jobseeker->id)->paginate(10);
        $data = [
            'transactions' => $transactions,
        ];
        return view('jobseeker.applied_jobs', $data);
    }

    public function bookmark_index()
    {
        $company_bookmarks = Bookmark::where('user_id', Auth::user()->id)
            ->where('type', '=', Constant::user_company)
            ->get();

        $job_bookmarks = Bookmark::where('user_id', Auth::user()->id)
            ->where('type', '=', Constant::job)
            ->get();

        $data = [
            'company_bookmarks' => $company_bookmarks,
            'job_bookmarks' => $job_bookmarks,
        ];

        return view('jobseeker.bookmark', $data);
    }

    public function bookmark_add_company($user_id)
    {
        $message = "";
        $company = User::find($user_id)->company;
        $isBookmarkExist = Bookmark::where('user_id', '=', Auth::user()->id)
            ->where('target', '=', User::find($user_id))
            ->where('type', '=', Constant::user_company)
            ->first();

        if($isBookmarkExist == null){
            $bookmark = Bookmark::create([
                'user_id' => Auth::user()->id,
                'target' => $company->id,
                'type' => Constant::user_company,
                'status' => Constant::status_active,
            ]);

            if($bookmark == null){
                $message = "Failed to bookmark company...";
            } else {
                $message = "Company successfully bookmarked!";
            }
        } else {
            $message = "Company already bookmarked...";
        }

        $data = ['message' => $message];
        return redirect()->route('company.index', $user_id)->with($data);
    }

    public function bookmark_remove_company($user_id)
    {
        $message = "";
        $company = User::find($user_id)->company;
        $bookmark = Bookmark::where('user_id', '=', Auth::user()->id)
            ->where('target', '=', $company->id)
            ->where('type', '=', Constant::user_company)
            ->first();

        if($bookmark->delete()){
            $message = "Company bookmark successfully removed!";
        } else {
            $message = "Failed to remove company bookmark...";
        }

        $data = ['message' => $message];
        return redirect()->route('company.index', $user_id)->with($data);
    }

    public function bookmark_add_job($job_id)
    {
        $message = "";
        $job = Job::find($job_id);
        $isBookmarkExist = Bookmark::where('user_id', '=', Auth::user()->id)
            ->where('target', '=', $job->id)
            ->where('type', '=', Constant::job)
            ->first();

        if($isBookmarkExist == null){
            $bookmark = Bookmark::create([
                'user_id' => Auth::user()->id,
                'target' => $job->id,
                'type' => Constant::job,
                'status' => Constant::status_active,
            ]);

            if($bookmark == null){
                $message = "Failed to bookmark job...";
            } else {
                $message = "Job successfully bookmarked!";
            }
        } else {
            $message = "Job already bookmarked...";
        }

        $data = ['message' => $message];
        return redirect()->route('job.index', $job_id)->with($data);
    }

    public function bookmark_remove_job($job_id)
    {
        $message = "";
        $job = Job::find($job_id);
        $bookmark = Bookmark::where('user_id', '=', Auth::user()->id)
            ->where('target', '=', $job->id)
            ->where('type', '=', Constant::job)
            ->first();

        if($bookmark->delete()){
            $message = "Job bookmark successfully removed!";
        } else {
            $message = "Failed to remove job bookmark...";
        }

        $data = ['message' => $message];
        return redirect()->route('job.index', $job_id)->with($data);
    }

    public function bookmark_remove($bookmark_id)
    {
        $message = "";
        $bookmark = Bookmark::find($bookmark_id);

        if($bookmark->delete()){
            $message = "Bookmark successfully removed!";
        } else {
            $message = "Failed to remove bookmark...";
        }

        $data = ['message' => $message];
        return redirect()->route('jobseeker.bookmark_index')->with($data);
    }

    public function report_job($job_id, Request $request){
        $message = "";

        $isReportExist = Report::where('jobseeker_id', '=', Auth::user()->jobseeker->id)
            ->where('job_id', '=', $job_id)
            ->where('type', '=', Constant::report_job)
            ->first();

        if($isReportExist == null){
            $report = Report::create([
                'jobseeker_id' => Auth::user()->jobseeker->id,
                'job_id' => $job_id,
                'type' => Constant::report_job,
                'description' => $request->get('description'),
                'status' => Constant::status_active,
            ]);

            if($report == null){
                $message = "Failed to report job...";
            } else {
                $message = "Job successfully reported!";
            }
        } else {
            $message = "Job already reported...";
        }

        $data = ['message' => $message];
        return redirect()->route('job.index', $job_id)->with($data);
    }
    
}
