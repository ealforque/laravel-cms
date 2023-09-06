<?php

declare(strict_types=1);

namespace App\Domains\User\Transformers;

use App\Domains\User\Interfaces\UserTransformerInterface;
use App\Infrastructure\Base\Interfaces\ModelInterface;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract implements UserTransformerInterface
{
    /**
     * List of fields possible to include.
     *
     * @var array
     */
    protected array $availableIncludes = [
        'username',
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
            'resource' => 'user',
            'ruid'     => $model->ruid,
        ];
    }

    /**
     * Include username.
     *
     * @param ModelInterface $model
     *
     * @return Primitive
     */
    public function includeUsername(ModelInterface $model): Primitive
    {
        return new Primitive($model->username);
    }
}
