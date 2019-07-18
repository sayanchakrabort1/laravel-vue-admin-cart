<?php

namespace App;

class Online
{
    public function isOnline()
    {
        return Cache::has('user-is-online'.session()->get('id'));
    }
}
