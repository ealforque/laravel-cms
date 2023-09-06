<?php

declare(strict_types=1);

namespace App\Domains\Contact\Interfaces;

use App\Domains\Contact\Models\Contact;
use App\Infrastructure\Base\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

interface ContactRepositoryInterface extends RepositoryInterface
{
    /**
     * Contact repository constructor definition.
     *
     * @param ContactInterface $model
     */
    public function __construct(ContactInterface $model);

    /**
     * Get repository model.
     *
     * @return Contact
     */
    public function getModel(): Contact;

    /**
     * Get contact list builder.
     *
     * @return Builder
     */
    public function getListBuilder(): Builder;
}
