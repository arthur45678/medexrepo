<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormatsDateFields
{
    /**
     * Return selected date attribute in specified format
     *
     * @param string $attribute
     * @param mixed $format
     * @return string
     */
    public function getFormattedDate(string $attribute, $format = "Y-m-d"): string
    {
        if ($format === true)
            $format = "Y-m-d\TH:i";

        return Carbon::parse($this->attributes[$attribute])->format($format);
    }
}
