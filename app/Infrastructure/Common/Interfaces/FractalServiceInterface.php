<?php

namespace App\Infrastructure\Common\Interfaces;

use App\Infrastructure\Base\Interfaces\ModelInterface;
use App\Infrastructure\Base\Interfaces\TransformerInterface;
use App\Infrastructure\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\SerializerAbstract;

interface FractalServiceInterface
{
    /**
     * Transform.
     *
     * @param ResourceInterface $resource
     *
     * @return array
     */
    public function transform(ResourceInterface $resource): array;

    /**
     * Transform collection.
     *
     * @param Collection $elements
     *
     * @return array
     */
    public function transformCollection(Collection $elements): array;

    /**
     * Transform Model.
     *
     * @param BaseModel $element
     *
     * @return array
     */
    public function transformModel(ModelInterface $element): array;

    /**
     * Set serializer.
     *
     * @param SerializerAbstract $serializer
     *
     * @return void
     */
    public function setSerializer(SerializerAbstract $serializer): void;

    /**
     * Set transformer.
     *
     * @param TransformerInterface $transformer
     *
     * @return void
     */
    public function setTransformer(TransformerInterface $transformer): void;

    /**
     * Get transformer.
     *
     * @return ?TransformerInterface
     */
    public function getTransformer(): ?TransformerInterface;

    /**
     * Include.
     *
     * @param string $name
     *
     * @return void
     */
    public function include(string $name): void;

    /**
     * Extend.
     *
     * @param string $name
     *
     * @return void
     */
    public function extend(string $name): void;

    /**
     * Exclude.
     *
     * @param string $name
     *
     * @return void
     */
    public function exclude(string $name): void;

    /**
     * Sort.
     *
     * @param string $sort
     *
     * @return array
     */
    public function sortOrder(string $sort): array;

    /**
     * Sort.
     *
     * @param string $sort
     *
     * @return array
     */
    public function filterData(string $sort): array;
}
