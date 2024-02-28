<?php

namespace App\Contracts\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasAttachments
{
    public function attachments(): MorphMany;
}
