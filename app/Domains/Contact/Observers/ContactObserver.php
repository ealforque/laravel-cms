<?php

declare(strict_types=1);

namespace App\Domains\Contact\Observers;

use App\Domains\Contact\Interfaces\ContactInterface;
use App\Infrastructure\Common\Interfaces\RUIDServiceInterface;

class ContactObserver
{
    /**
     * RUID.
     *
     * @var RUIDServiceInterface
     */
    private RUIDServiceInterface $ruid;

    /**
     * ContactObserver constructor.
     *
     * @param RUIDServiceInterface $ruid
     */
    public function __construct(RUIDServiceInterface $ruid)
    {
        $this->ruid = $ruid;
    }

    /**
     * Handle the contact "creating" event.
     *
     * @param ContactInterface $contact
     *
     * @return void
     */
    public function creating(ContactInterface $contact): void
    {
        $contact->ruid = $this->ruid->generate($contact);
    }
}
