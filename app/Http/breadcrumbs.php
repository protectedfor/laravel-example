<?php
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('На главную', route('home'));
});

// Home > About
Breadcrumbs::register('works_create', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Добавление работы', route('works.create'));
});

Breadcrumbs::register('users_index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Пользователи', route('users.index'));
});

Breadcrumbs::register('users_show', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('users_index');
    $breadcrumbs->push($user->name, route('users.show', $user->id));
});