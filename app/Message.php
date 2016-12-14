<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    static public function notification_report_job($jobseeker_name, $job_name, $company_name, $description){
        return $jobseeker_name." has reported job: ".$job_name." by company: ".$company_name."with the following description: ".$description;
    }
}
