<?php

declare(strict_types=1);

namespace App\Domains\Contact\Transformers;

use App\Domains\Contact\Interfaces\ContactTransformerInterface;
use App\Domains\User\Transformers\UserTransformer;
use App\Infrastructure\Base\Interfaces\ModelInterface;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;

class ContactTransformer extends TransformerAbstract implements ContactTransformerInterface
{
    /**
     * List of fields possible to include.
     *
     * @var array
     */
    protected array $availableIncludes = [
        'firstname',
        'lastname',
        'contact_no',
        'email_address',
        'login',
    ];

    /**
     * Turn this item object into a generic array.
     *
     * @param ModelInterface $model
     *
     * @return array
     */
    public function transform(ModelInterface $model): array
    {
        return [
            'resource' => 'contact',
            'ruid'     => $model->ruid,
        ];
    }

    /**
     * Include first name.
     *
     * @param ModelInterface $model
     *
     * @return Primitive
     */
    public function includeFirstName(ModelInterface $model): Primitive
    {
        return new Primitive($model->firstname);
    }

    /**
     * Include last name.
     *
     * @param ModelInterface $model
     *
     * @return Primitive
     */
    public function includeLastName(ModelInterface $model): Primitive
    {
        return new Primitive($model->lastname);
    }

    /**
     * Include contact no.
     *
     * @param ModelInterface $model
     *
     * @return Primitive
     */
    public function includeContactNo(ModelInterface $model): Primitive
    {
        return new Primitive($model->contact_no);
    }

    /**
     * Include email_address address.
     *
     * @param ModelInterface $model
     *
     * @return Primitive
     */
    public function includeEmailAddress(ModelInterface $model): Primitive
    {
        return new Primitive($model->email_address);
    }

    /**
     * Include username address.
     *
     * @param ModelInterface $model
     *
     * @return Item
     */
    public function includeLogin(ModelInterface $model): Item
    {
        return $this->item($model->login, new UserTransformer);
    }
}
