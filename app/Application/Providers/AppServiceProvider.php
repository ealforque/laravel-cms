<?php

namespace App\Application\Providers;

use App\Domains\Contact\Providers\ContactServiceProvider;
use App\Infrastructure\Base\Interfaces\RUIDModelInterface;
use App\Infrastructure\Common\Services\RUIDService;
use App\Infrastructure\Common\Traits\RUIDTrait;
use App\Infrastructure\Providers\InfraServiceProvider;
use Faker\Factory as FakerFactory;
use Faker\Generator;
use Faker\Provider\Base as FakerBase;
use Hidehalo\Nanoid\Client;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RUIDService::class, function ($app) {
            return new RUIDService($app->make(Client::class));
        });

        $this->app->singleton(Generator::class, function ($app) {
            $faker = FakerFactory::create();
            $newClass = new class($faker) extends FakerBase {
                public function ruid()
                {
                    $model = new class implements RUIDModelInterface {
                        use RUIDTrait;

                        public static function getByRUID(string $ruid): ?RUIDModelInterface
                        {
                            return null;
                        }
                    };

                    return Container::getInstance()->make(RUIDService::class)->generate($model);
                }
            };
            $faker->addProvider($newClass);

            return $faker;
        });

        $this->app->register(InfraServiceProvider::class);
        $this->app->register(ContactServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
