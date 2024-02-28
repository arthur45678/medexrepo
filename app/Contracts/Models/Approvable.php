<?php

namespace App\Contracts\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Approvable
{
    public function approvement(): MorphOne;

    public function approvementStatus(): string;
}
