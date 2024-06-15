<?php

use Carbon\Carbon;

if (!function_exists('format_datetime_to_array')) {
    function formatDatetime($datetime)
    {
        $carbonDateTime = Carbon::parse($datetime);

        return [
            'date' => $carbonDateTime->format('d/m/Y'),
            'time' => $carbonDateTime->format('H:i')
        ];
    }
}
