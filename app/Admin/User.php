<?php

Admin::model('App\User')->title('Users')->display(function () {
    $display = AdminDisplay::table();
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
            ],
            [
                FormItem::text('email', 'Email')->required()->unique(),
            ],
        ]),
    ]);
    return $form;
});