<?php

declare(strict_types=1);

namespace App\Domains\Contact\Repositories;

use App\Domains\Contact\Interfaces\ContactInterface;
use App\Domains\Contact\Interfaces\ContactRepositoryInterface;
use App\Domains\Contact\Models\Contact;
use Illuminate\Database\Eloquent\Builder;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * Model.
     *
     * @var Contact
     */
    private Contact $model;

    /**
     * Contact repository constructor.
     *
     * @param ContactInterface $model
     */
    public function __construct(ContactInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Get repository model.
     *
     * @return Contact
     */
    public function getModel(): Contact
    {
        return $this->model;
    }

    /**
     * Get contact list builder.
     *
     * @return Builder
     */
    public function getListBuilder(): Builder
    {
        return $this->model->select();
    }
}
