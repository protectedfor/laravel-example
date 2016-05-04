<?php

Admin::model(\App\User::class)->title('Users')->display(function () {
    $display = AdminDisplay::datatables();
    $display->columns([
        Column::string('id')->label('#'),
        Column::string('name')->label('Name'),
        Column::string('email')->label('Email'),
    ]);
    return $display;
})->createAndEdit(function () {
    $form = AdminForm::form();
    $form->items([
        FormItem::columns()->columns([
            [
                FormItem::text('name', 'Name')->required(),
                FormItem::multiselect('roles', 'Роли')->model(\App\Models\Role::class)->display('title'),
                FormItem::text('email', 'Email')->required()->unique(),
            ],
            [
            ],
        ]),
    ]);
    return $form;
});