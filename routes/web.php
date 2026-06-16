<?php

use App\Livewire\Posts;
use Illuminate\Support\Facades\Route;

Route::get('/', Posts\PostList::class)->name('posts');
