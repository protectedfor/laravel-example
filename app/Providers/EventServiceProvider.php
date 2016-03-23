<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Message;
use App\User;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
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

        Book::creating(function($book){
            if(strlen($book->description) <= 6){
                return false;
            }
            return true;
        });

        Book::created(function($book){
            Message::create([
                'name' => $book->description,
                'message' => 'This message created after book item created'
            ]);
        });
    }
}
