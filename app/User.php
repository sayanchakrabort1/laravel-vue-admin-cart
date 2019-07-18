<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "registered_user";

    public function isOnline()
    {
        $temp=1;

        // print_r("id fetch: ".$temp."<br>");
        // print_r("Cache with temp: ".Cache::get('user-is-online-'.$temp)."<br>");

        while ($temp < 10000) {
            if (Cache::get('user-is-online-'.$temp) != "") {
                // array_push($matrix, Cache::get('user-is-online-'.$temp));
                $a[$temp] = Cache::get('user-is-online-'.$temp);
            }
            $temp++;
        }

        // print_r($a);
        // print_r(Cache::tags(['id'])->get());

        return $a;
    }
}
