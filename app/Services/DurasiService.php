<?php

namespace App\Services;

use Carbon\Carbon;

class DurasiService 
{
    public static function totalHari($start, $end):int
    {
        $mulai = Carbon::parse($start);
        $berakhir = Carbon::parse($end);
        $totalHari = $mulai->diffInDays($berakhir);
        return $totalHari;
    }
}