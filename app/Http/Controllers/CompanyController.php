<?php

namespace App\Http\Controllers;

use App\Job;
use App\Jobseeker;
use App\Constant;
use App\Transaction;
use App\User;
use App\Bookmark;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\Post_jobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Psy\Test\CodeCleaner\ValidClassNamePassTest;

class CompanyController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('company', ['except' => [
            'index',
        ]]);
    }

    public function index($user_id)
    {
        $user = User::findOrFail($user_id);
        if($user->role == Constant::user_company){
            $jobs = $user->company->job()->where('status', '=', Constant::status_active)->get();

            $data = [
                'user' => $user,
                'jobs' => $jobs,
            ];
            return view('company.profile', $data);
        } else {
            return redirect('/');
        }
    }

    public function edit($user_id){
        $user = User::find($user_id);
        if($user != null){
            $data = ['user' => $user];
            return view('company.profile_edit', $data);
        } else {
            return redirect('/');
        }
    }

    public function update($user_id, CompanyRequest $request)
    {
        $user = User::find($user_id);
        if ($user != null) {
            $user->phone = $request->get('phone');
            $user->description = $request->get('description');
            $user->location = $request->get('location');
            $user->company->industry = $request->get('industry');
            $user->company->website = $request->get('website');
            $user->company->size = $request->get('size');

            if ($request->has('password')) {
                $user->password = bcrypt($request->get('password'));
            }

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photo_name = md5(uniqid()) . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path() . '/images/', $photo_name);
                $user->photo = $photo_name;
            }

            $user->save();
            $user->company->save();
            return redirect()->route('company.index', $user_id);
        } else {
            return redirect('/');
        }
    }

    public function post_job()
    {
        return view('company.post_job');
    }

    public function store(Post_jobRequest $request)
    {
        $job = new Job();
        $job->company_id = Auth::user()->company->id;
        $job->job_category_id = Input::get('job_category_id');
        $job->name = Input::get('name');
        $job->location = Input::get('location');
        $job->type = Input::get('type');
        $job->salary = Input::get('salary');
        $job->period = Input::get('period');
        $job->benefit = Input::get('benefit');
        $job->requirement = Input::get('requirement');
        $job->description = Input::get('description');
        $job->status = Constant::status_active;
        $job->save();

        return redirect('/company/manage_post')->with('success', 'New Job Added');
    }

    public function manage_post()
    {
        $job = Job::select('*')
            ->where('company_id', '=', Auth::user()->company->id)
            ->orderBy('created_at','desc')
            ->paginate(10);
        $data = [
            'jobs' => $job
        ];
        return view('company.manage_post', $data);
    }

    public function manage_post_edit($id)
    {
        $job = Job::find($id);
        $data = ['job' => $job];

        return view('company.manage_post_edit', $data);
    }

    public function manage_post_update($id)
    {
        $job = Job::find($id);
        $job->job_category_id = Input::get('job_category_id');
        $job->name = Input::get('name');
        $job->type = Input::get('type');
        $job->salary = Input::get('salary');
        $job->period = Input::get('period');
        $job->benefit = Input::get('benefit');
        $job->requirement = Input::get('requirement');
        $job->description = Input::get('description');
        $job->save();

        return redirect('/company/manage_post/')->with('success','Job Updated with ID: '.$id);
    }

    public function manage_post_close($id)
    {
        $job = Job::find($id);
        $job->status = Constant::status_inactive;
        $job->save();
        return redirect('/company/manage_post/')->with('success', 'Job Closed with ID: '.$id);
    }

    public function indexJobseeker()
    {
        $users = User::select('*')
            ->where('role','=','2')
            ->paginate(5);
        $data = ['users' => $users];
        return view('company.search_jobseeker', $data);
    }

    public function searchJobseeker(Request $request)
    {
        $search = $request->input('search');
        $university = $request->input('university');
        $major = $request->input('major');
        $gender = $request->input('gender');

        if ($university != null || $major != null || $gender != null || $university == "" || $major == "" || $gender =="") {
            $query = User::join('jobseekers','users.id','=','jobseekers.user_id')
            ->where('users.name', 'LIKE', '%'. $search .'%')
            ->where('users.status',Constant::status_active)
            ->select('users.*');
        } else {
            $query = User::where('users.name', 'LIKE', '%' . $search . '%')
            ->where('users.status', Constant::status_active);
        }

        if($university != null || $university == ""){
            $query->where('jobseekers.university', 'LIKE', '%' . $university . '%');
        }
        if($major != null || $major == ""){
            $query->where('jobseekers.major','LIKE', '%' . $major . '%');
        }
        if($gender != null){
            $query->where('jobseekers.gender','=',$gender);
        }

        $users = $query->orderBy('users.id')->paginate(5);

        if (count($users) == 0) {
            return view('company.search_jobseeker')
                ->with('message', 'Jobseeker not Found')
                ->with('search', $search);
        } else {

            return view('company.search_jobseeker')
                ->with('users', $users)
                ->with('search', 'Looking for' . ' ' . $search);
        }
    }

    public function view_candidate($id)
    {
        $transaction = Job::find($id)->transaction;
        $data = ['transactions' => $transaction];

        return view('company.candidate',$data);
    }

    public function view_resume($id)
    {
       $resume = Jobseeker::find($id)->resume;

        return response()->file(public_path().'\\uploads\\'.$resume);
    }

    public function approve($id)
    {
        $transaction = Transaction::find($id);

        $transaction->status = Constant::status_active;
        $transaction->save();

        return back();
    }

    public function bookmark_jobseeker()
    {
        $bookmark = Bookmark::select('*')
        ->where('user_id','=',Auth::user()->id)
        ->orderBy('created_at','desc')
        ->paginate(10);
        //dd($bookmark);
        $data = [
            'bookmarks' => $bookmark
        ];

        return view('company.bookmark_jobseeker',$data);
    }

    public function add_bookmark_jobseeker($id)
    {
        $bookmark = null;
        $isBookmarkExist = Bookmark::where('target','=',User::find($id)->jobseeker->id)
            ->where('user_id','=',Auth::user()->id)
            ->first();

        if($isBookmarkExist == null)
        {
            $bookmark = new Bookmark();
            $bookmark->user_id = Auth::user()->id;
            $bookmark->target = User::find($id)->jobseeker->id;
            $bookmark->type = Constant::user_jobseeker;
            $bookmark->status = Constant::status_active;

            $bookmark->save();

            if($bookmark == null)
            {
                $message = "Failed to Bookmark Job Seeker";
            }
            else
            {
                $message = "Job Seeker Bookmarked";
            }
        }
        else
        {
            $message = "Already in Bookmark";
        }


        return back()->with('success',$message);
    }

    public function delete_bookmark_jobseeker($id)
    {
        $bookmark = Bookmark::find($id);

        $bookmark->delete();

        return redirect('company/bookmark_jobseeker')->with('success',"Bookmark Removed");
    }

    public function remove_bookmark_jobseeker($id)
    {

        $jobseeker = User::find($id)->jobseeker;
        $bookmark = Bookmark::where('target','=',User::find($id)->jobseeker->id)
            ->where('target', '=', $jobseeker->id)
            ->where('type', '=', Constant::user_jobseeker)
            ->first();

        if($bookmark->delete()){
            $message = "Job Seeker bookmark successfully removed!";
        } else {
            $message = "Failed to remove Job Seeker bookmark...";
        }

        $data = ['message' => $message];
        return redirect()->route('jobseeker.index', $id)->with($data)->with($message);

    }


}
