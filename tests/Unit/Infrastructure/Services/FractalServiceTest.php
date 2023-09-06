<?php

declare(strict_types=1);

namespace App\Tests\Common\Services;

use App\Infrastructure\Base\Interfaces\RUIDModelInterface;
use App\Infrastructure\Common\Services\RUIDService;
use Hidehalo\Nanoid\Client;
use Illuminate\Support\Str;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class FractalServiceTest extends TestCase
{
    public function testGenerate()
    {
        $id = Str::random(RUIDService::LENGTH);

        /**
         * @var Client&MockInterface
         */
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('formattedId')->with(RUIDService::ALPHABET, RUIDService::LENGTH)->andReturn($id);

        /**
         * @var MockInterface&RUIDModelInterface
         */
        $model = Mockery::mock(RUIDModelInterface::class);
        $model->shouldReceive('getByRUID')->with($id)->andReturn(null);

        $ruid = new RUIDService($client);
        $this->assertEquals($id, $ruid->generate($model));
    }
}
