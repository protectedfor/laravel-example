<?php

Admin::model(\App\Models\Category::class)->title('Категории')->display(function () {
    $display = AdminDisplay::tree();
    $display->value('title');
    return $display;
})->createAndEdit(function () {
    $form = AdminForm::form();
    $form->items([
        FormItem::columns()->columns([
            [
                FormItem::text('title', 'Название')->required(),
            ],
            [
            ],
        ]),
    ]);
    return $form;
});