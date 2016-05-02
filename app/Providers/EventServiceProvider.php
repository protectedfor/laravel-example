<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Message;
use App\Models\Photo;
use App\Models\Work;
use App\User;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Request;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegisteredEvent' => [
            'App\Listeners\UserRegisteredListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        Work::saved(function($entity){
            $imgs = [];
            foreach (Request::get('images', []) as $img) {
                $img = str_replace(config('admin.imagesUploadDirectory') . '/', '', $img);
                $imgs[] = Photo::create(['imageable_id' => $entity->id, 'path' => $img]);
            }
            $entity->photos()->saveMany($imgs);
        });
    }
}
