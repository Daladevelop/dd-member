<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;
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
        $user->email = "admin@example.com";
        $user->password = bcrypt('admin');
        $user->personal_number = '123';
        $user->city = 'Staden';
        $user->phone = '123';
        $user->save();
        Bouncer::assign('admin')->to($user);
        echo 'Created user admin@example.com with password admin';

        $event = new App\Event;
        $event->name = "My first event";
        $event->description = "The first event ever! Free snacks!";
        $event->start_date = "2018-03-25 14:00:00";
        $event->end_date = "2018-03-25 23:00:00";
        $event->cost = "200";
        $event->max_participants = "30";
        $event->members_only = true;
        $event->save();
        echo 'Created sample event';
    }
}
