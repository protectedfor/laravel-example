<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');
Admin::menu(\App\User::class)->label('Пользователи')->icon('fa-users');
Admin::menu(\App\Models\Work::class)->label('Работы')->icon('fa-eraser');
Admin::menu(\App\Models\Category::class)->label('Категории')->icon('fa-eraser');
