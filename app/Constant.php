<?php
/**
 * Created by PhpStorm.
 * User: Hashner
 * Date: 12/2/2016
 * Time: 10:37 PM
 */

namespace App;


class Constant
{
    const user_admin = '0';
    const user_company ='1';
    const user_jobseeker = '2';
    const job = '3';

    const default_photo = "images/profile_default.jpg";

    const status_inactive = '0';
    const status_active = '1';
    const status_banned = '2';

    const gender_male = '0';
    const gender_female = '1';

    const job_parttime ='0';
    const job_fulltime ='1';

    const job_notpaid = '0';
    const job_paid ='1';

    const jobseeker_male = '0';
    const jobseeker_female= '1';

    const notification_report = '0';
    const notification_apply = '1';
    const notification_apply_approved = '2';

    const report_job = '4';
}