<?php

use App\User;
use App\Company;
use App\Jobseeker;
use App\Constant;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Edward Hashner',
            'email' => 'edwardhashner@gmail.com',
            'password' => bcrypt('qwerty'),
            'role' => Constant::user_admin,
            'location' => 'Jln. U No 18A, Kemanggisan, Jakarta',
            'description' => 'Binus University - 1701355892',
            'status' => Constant::status_active,
        ]);

        $user_company = User::create([
            'name' => 'Axel Soedarsono',
            'email' => 'axelsoedarsono@gmail.com',
            'password' => bcrypt('qwerty'),
            'role' => Constant::user_company,
            'location' => 'Jln. U No 18A, Kemanggisan, Jakarta',
            'description' => 'Binus University - 1701314545',
            'status' => Constant::status_active,
        ]);

        Company::create([
            'user_id' => $user_company->id,
            'website' => 'axelsoedarsono.blogspot.com',
            'industry' => 'Technology',
            'size' => 500,
        ]);

        $user_jobseeker = User::create([
            'name' => 'Alfredo Morgen',
            'email' => 'alfredomorgen@gmail.com',
            'password' => bcrypt('qwerty'),
            'role' => Constant::user_jobseeker,
            'phone' => '087897255266',
            'location' => 'Jln. U No 18A, Kemanggisan, Jakarta',
            'description' => 'Binus University - 1701351162',
            'status' => Constant::status_active,
        ]);

        Jobseeker::create([
            'user_id' => $user_jobseeker->id,
            'gender' => Constant::gender_male,
            'dob' => '1995-10-07',
            'gpa' => '3.86',
            'major' => 'IT',
            'university' => 'Binus University',
        ]);

        factory(App\User::class, 'jobseeker', 20)->create()->each(function ($jobseeker){
            $jobseeker->jobseeker()->save(factory(App\Jobseeker::class)->create());
        });

        factory(App\User::class, 'company', 20)->create()->each(function ($u){
            $u->company()->save(factory(App\Company::class)->create())->each(function ($company){
                $company->job()->save(factory(App\Job::class)->make());
            });
        });
    }
}
