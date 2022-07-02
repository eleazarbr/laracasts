<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // It will throw the "Allowed memory size of bytes exhausted" error.
    // $users = User::get()->filter(function ($user) {
    //     return $user->id < 250000;
    // });

    // Creates a lazy collection.
    // The filter callback is not executed until we actually iterate over
    // each user individually, allowing for a drastic reduction in memory usage.
    $users = User::cursor()
        ->filter(function ($user) {
            return $user->id < 100;
        })
        ->take(100);

    foreach ($users as $user) {
        echo "$user->id \n";
    }
});
