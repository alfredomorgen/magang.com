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
use App\Report;
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
        $job = Job::findOrFail($id);
        $job->status= Constant::status_banned;
        $job->save();

        $message = "Company successfully deactivated!";
        $data = ['message' => $message];

        return back()->with($data);
    }

    public function deleteCompany($id)
    {
        $user= User::findOrFail($id);
        $user->status = Constant::status_inactive;
        $user->company->job()->update([
            'status' => Constant::status_inactive
        ]);
        $user->save();

        $message = "Company successfully deactivated!";
        $data = ['message' => $message];

        return back()->with($data);
    }
    public function deleteJobseeker($id)
    {
        $user = User::findOrFail($id);
        $user->status = Constant::status_inactive;
        $user->save();

        $message = "Jobseeker successfully deactivated!";
        $data = ['message' => $message];

        return back()->with($data);
    }

    public function report_index()
    {
        $reports = Report::all()
            ->where('status', '=', Constant::report_status_pending);
        $data = [
            'reports' => $reports,
        ];
        return view('admin.report_index', $data);
    }

    public function report_close($report_id)
    {
        $report = Report::findOrFail($report_id);
        $report->status = Constant::report_status_closed;
        $report->save();

        $message = "Report successfully closed!";
        $data = ['message' => $message];

        return back()->with($data);
    }
}