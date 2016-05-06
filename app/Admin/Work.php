<?php

Admin::model(\App\Models\Work::class)->title('Works')->display(function () {
    $display = AdminDisplay::table();
    $display->columns([
        Column::string('id')->label('#'),
        Column::image('mainImage')->label('Изображение'),
        Column::string('title')->label('Название'),
        Column::string('slug')->label('ЧПУ'),
        Column::custom()->label('Описание')->callback(function ($instance) {
            return str_limit(strip_tags($instance->description));
        }),
        Column::string('user.name')->label('Пользователь'),
        Column::string('views')->label('Просмотров'),
    ]);
    return $display;
})->createAndEdit(function () {
    $form = AdminForm::form();
    $form->items([
        FormItem::columns()->columns([
            [
                FormItem::text('title', 'Название')->required(),
                FormItem::text('slug', 'ЧПУ'),
//                FormItem::textarea('description', 'Описание')->required(),
                FormItem::select('user_id', 'Пользователь')->model(\App\User::class)->display('name'),
                FormItem::images('images', 'Изображения'),
                FormItem::text('views', 'Количество просмотров'),
                FormItem::ckeditor('description', 'Описание'),
//                FormItem::date('created_at', 'Дата'),
//                FormItem::time('created_at', 'Время'),
//                FormItem::timestamp('created_at', 'Дата время'),
//                FormItem::checkbox('active', 'Активен'),
//                FormItem::file('image', 'Файл'),
//                FormItem::image('image', 'Изображение'),
            ],
//            [
//            ]
        ]),
    ]);
    return $form;
});