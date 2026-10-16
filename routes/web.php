<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/objets');

Route::view('/composants', 'styleguide')->name('styleguide');
