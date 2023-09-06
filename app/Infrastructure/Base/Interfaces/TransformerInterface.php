<?php

declare(strict_types=1);

namespace App\Infrastructure\Base\Interfaces;

interface TransformerInterface
{
    /**
     * Transforms model to return by API.
     *
     * @see https://fractal.thephpleague.com/transformers/
     *
     * @param ModelInterface $model
     *
     * @return array
     */
    public function transform(ModelInterface $model): array;
}
