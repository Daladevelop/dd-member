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
        $memberfee = new App\MemberFee;
        $memberfee->year = \Carbon\Carbon::now()->year;
        $memberfee->amount = 200;
        $memberfee->amount_student = 100;
        $memberfee->amount_child =50;
        $memberfee->save();
        echo 'MemberFee create for year ' . $memberfee->year . "\r\n";

        $user = new App\User;
        $user->name = "Administrator";
        $user->email = "admin@example.com";
        $user->password = bcrypt('admin');
        $user->personal_number = '123';
        $user->city = 'Staden';
        $user->phone = '123';
        $user->save();
        Bouncer::assign('admin')->to($user);
        echo 'Created user admin@example.com with password admin' . "\r\n";

        $event = new App\Event;
        $event->name = "My first event";
        $event->description = "The first event ever! Free snacks!";
        $event->start_date = "2018-03-25 14:00:00";
        $event->end_date = "2018-03-25 23:00:00";
        $event->cost = "200";
        $event->max_participants = "30";
        $event->members_only = true;
        $event->save();
        echo 'Created sample event' . "\r\n";
    }
}
