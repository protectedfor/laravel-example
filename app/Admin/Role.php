<?php

Admin::model(\App\Models\Role::class)->title('Roles')->display(function () {
    $display = AdminDisplay::datatables();
    $display->columns([
        Column::string('id')->label('#'),
        Column::string('title')->label('Title'),
    ]);
    return $display;
})->createAndEdit(function () {
    $form = AdminForm::form();
    $form->items([
        FormItem::columns()->columns([
            [
                FormItem::text('title', 'Title')->required(),
            ],
            [
            ],
        ]),
    ]);
    return $form;
});