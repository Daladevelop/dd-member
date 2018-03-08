<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;
        $user->name = "Administrator";
        $user->email = "admin@admin.com";
        $user->password = bcrypt('admin');
        $user->personal_number = '123';
        $user->city = 'Staden';
        $user->save();
        Bouncer::assign('admin')->to($user);
        /* DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]); */

        $event = new App\Event;
        $event->name = "My first event";
        $event->description = "The first event ever! Free snacks!";
        $event->start_date = "2018-03-25 14:00:00";
        $event->end_date = "2018-03-25 23:00:00";
        $event->cost = "200";
        $event->max_participants = "30";
        $event->members_only = true;
        $event->save();
    }
}
