<?php

/**
 * Convert hours to days with hours and minutes
 * example-param: $summary = $hm = ['h' => 34, 'm' => 66];
 *
 * @param  array  $hm
 * @return array
 */
function hoursToDayHour(array $hm): array
{
    $days = 0;
    $hours = 0;
    $minutes = 0;
    $h = $hm['h'];
    $m = $hm['m'];

    if ($h / 24 > 1) { // when hours are greater then one day

        $days = floor($h / 24);
        $hours = $h - $days * 24;
    } else { // when hours are less then one day

        $days = 0;
        $hours = $h;
    }
    return ['d' => $days, 'h' => $hours, 'm' => $minutes];
}

/**
 * Convert  minutes to days with hours and minutes
 * example-param: $summary = $hm = ['h' => 34, 'm' => 66];
 *
 * @param  array  $hm
 * @return array
 */
function minutesToDayHour(array $hm): array
{
    $days = 0;
    $hours = 0;
    $minutes = 0;
    $h = $hm['h'];
    $m = $hm['m'];

    if ($m / 1440 > 1) { // when minutes are greater then one day

        $days = floor($m / 1440);
        $minutes_diff = $m - $days * 1440;

        if ($minutes_diff / 60 > 1) {
            $hours = floor($minutes_diff / 60);
            $minutes = $minutes_diff - $hours * 60;
        } else {
            $minutes = $minutes_diff;
        }
    } else { // when hours are less then one day

        if ($m / 60 > 1) {
            $hours = floor($m / 60);
            $minutes = $m - $hours * 60;
        } else {
            $minutes = $m;
        }
    }
    return ['d' => $days, 'h' => $hours, 'm' => $minutes];
}

/**
 * Calculate summary of two convertation - hoursToDayHour and minutesToDayHour
 * example-param: $summary = $hm = ['h' => 34, 'm' => 66];
 *
 * @param  array  $hm
 * @return array
 */
function minutesHoursToDayHour(array $hm): array
{
    $result = null;
    $hoursToDayHour = hoursToDayHour($hm);
    $minutesToDayHour = minutesToDayHour($hm);

    foreach ($hoursToDayHour as $key => $value) {
        $result[$key] = (int) $value + (int) $minutesToDayHour[$key];
    }
    return $result;
}

/**
 * Reduce summary of hours and minutes for given days of month
 * example-param: $month_days = [1 => '', ....., 31 => ''];
 *
 * @param  array  $month_days
 * @return array
 */
function reduceHoursMinutesSummary(array $month_days): array
{
    $summary = collect($month_days)->reduce(function ($carry, $item) {
        $item_split = explode(':', $item);
        if (count($item_split) === 2) {
            $h = ltrim($item_split[0], '0');
            $m = ltrim($item_split[1], '0');
            $carry['h'] += (int)($h);
            $carry['m'] += (int)($m);
            return $carry;
        }
        return $carry;
    }, ['h' => 0, 'm' => 0]);
    return $summary;
}



function viewYearMonthDay($date){
    dd($date);
    $date = new \Carbon\Carbon();
    echo $date->format('Y-m-d');
}
