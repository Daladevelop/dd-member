<?php
/**
 * Created by PhpStorm.
 * User: larsemil
 * Date: 2018-03-08
 * Time: 11:26
 */

namespace App\Helpers;


class Helper
{
    public static function message($title, $content, $type){
        session()->flash('message_title', $title);
        session()->flash('message_content', $content);
        session()->flash('message_type', $type);

    }

    public static function createYearlyFee(){

        $memberfee = new \App\MemberFee;
        $memberfee->year = \Carbon\Carbon::now()->year;
        $memberfee->amount = 200;
        $memberfee->amount_student = 100;
        $memberfee->amount_child =50;
        $memberfee->save();
        return $memberfee;
    }



}