<?php
/**
 * Created by PhpStorm.
 * User: Hashner
 * Date: 12/2/2016
 * Time: 11:23 PM
 */

namespace App\Http\Controllers;


use App\Company;
use App\Constant;
use App\Jobseeker;
use App\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function deleteJob($id)
    {
        $job = Job::find($id);
        $job->status= Constant::status_banned;
        $job->save();
        return redirect('/admin/search_job');
    }

    public function deleteCompany($id)
    {
        $user= User::find($id);

        $user->status = Constant::status_inactive;
        $user->company->job()->update([
            'status' => Constant::status_inactive
        ]);
        $user->save();
        return redirect('/admin/search_company');
    }
    public function deleteJobseeker($id)
    {
        $user = User::find($id);
        $user->status = Constant::status_inactive;
        $user->save();
        return redirect('/admin/search_jobseeker');
    }
}