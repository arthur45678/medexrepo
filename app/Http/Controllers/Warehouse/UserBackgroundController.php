<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Samples\WarehouseModels;
use App\Models\User;
use Illuminate\Http\Request;

class UserBackgroundController extends Controller
{


    public function background()
    {



$user=User::find(auth()->id());

if ($user->background=="c-app"){

    $user->update([
        'background'=>"c-app  c-dark-theme"
    ]);
}else{

    $user->update([
        'background'=>"c-app"
    ]);
}
    }

}
