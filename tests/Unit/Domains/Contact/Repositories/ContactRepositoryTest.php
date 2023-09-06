<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Contact\Repositories;

use App\Domains\Contact\Models\Contact;
use App\Domains\Contact\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class ContactRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetModel()
    {
        $contactMock = Mockery::mock(Contact::class);
        $contactRepository = new ContactRepository($contactMock);

        $this->assertEquals(
            $contactMock,
            $contactRepository->getModel()
        );
    }

    public function testGetContactListBuilder()
    {
        $contactMock = Mockery::mock(Contact::class);
        $builderMock = Mockery::mock(Builder::class);

        $contactMock
            ->shouldReceive('select')
            ->once()
            ->withNoArgs()
            ->andReturn($builderMock);

        $contactRepository = new ContactRepository($contactMock);

        $this->assertEquals(
            $builderMock,
            $contactRepository->getListBuilder()
        );
    }
}
