<?php

declare(strict_types=1);

namespace App\Domains\Contact\Providers;

use App\Domains\Contact\Interfaces\ContactInterface;
use App\Domains\Contact\Interfaces\ContactRepositoryInterface;
use App\Domains\Contact\Interfaces\ContactServiceInterface;
use App\Domains\Contact\Interfaces\ContactTransformerInterface;
use App\Domains\Contact\Models\Contact;
use App\Domains\Contact\Observers\ContactObserver;
use App\Domains\Contact\Repositories\ContactRepository;
use App\Domains\Contact\Services\ContactService;
use App\Domains\Contact\Transformers\ContactTransformer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Contact::observe(ContactObserver::class);
        Route::model('contact', Contact::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContactInterface::class, Contact::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(ContactServiceInterface::class, ContactService::class);
        $this->app->bind(ContactTransformerInterface::class, ContactTransformer::class);
    }
}
