<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Services;

use App\Infrastructure\Base\Interfaces\ModelInterface;
use App\Infrastructure\Base\Interfaces\TransformerInterface;
use App\Infrastructure\Common\Interfaces\FractalServiceInterface;
use App\Infrastructure\Common\Serializers\FractalDataArraySerializer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\SerializerAbstract;

class FractalService implements FractalServiceInterface
{
    /**
     * Fractal manager.
     *
     * @var Manager
     */
    private Manager $fractal;

    /**
     * Transformer.
     *
     * @var TransformerInterface
     */
    private TransformerInterface $transformer;

    /**
     * Fractal service constructor.
     *
     * @param Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->fractal = $manager;
        $this->fractal->setSerializer(new FractalDataArraySerializer);
    }

    /**
     * Transform.
     *
     * @param ResourceInterface $resource
     *
     * @return array
     */
    public function transform(ResourceInterface $resource): array
    {
        return $this->fractal->createData($resource)->toArray();
    }

    /**
     * Transform collection.
     *
     * @param EloquentCollection $elements
     *
     * @return array
     *
     * // TODO: Remove coverage ignore if used; currently not in use
     *
     * @codeCoverageIgnore
     */
    public function transformCollection(EloquentCollection $elements): array
    {
        return $this->transform(new Collection($elements, $this->transformer));
    }

    /**
     * Transform model.
     *
     * @param ModelInterface $element
     *
     * @return array
     *
     * @codeCoverageIgnore
     */
    public function transformModel(ModelInterface $element): array
    {
        return $this->transform(new Item($element, $this->transformer));
    }

    /**
     * Set serializer.
     *
     * @param SerializerAbstract $serializer
     *
     * @return void
     *
     * // TODO: Remove coverage ignore if used; currently not in use
     *
     * @codeCoverageIgnore
     */
    public function setSerializer(SerializerAbstract $serializer): void
    {
        $this->fractal->setSerializer($serializer);
    }

    /**
     * Set transformer.
     *
     * @param TransformerInterface $transformer
     *
     * @return void
     */
    public function setTransformer(TransformerInterface $transformer): void
    {
        $this->transformer = $transformer;
    }

    /**
     * Get transformer.
     *
     * @return ?TransformerInterface
     */
    public function getTransformer(): ?TransformerInterface
    {
        return $this->transformer;
    }

    /**
     * Include.
     *
     * @param string $name
     *
     * @return void
     */
    public function include(string $name): void
    {
        $this->fractal->parseIncludes($name);
    }

    /**
     * Extend.
     *
     * @param string $name
     *
     * @return void
     *
     * // TODO: Remove coverage ignore if used; currently not in use
     *
     * @codeCoverageIgnore
     */
    public function extend(string $name): void
    {
        $method = 'set' . ucfirst($name);
        $this->transformer->$method();
    }

    /**
     * Exclude.
     *
     * @param string $name
     *
     * @return void
     *
     * // TODO: Remove coverage ignore if used; currently not in use
     *
     * @codeCoverageIgnore
     */
    public function exclude(string $name): void
    {
        $this->fractal->parseExcludes($name);
    }

    /**
     * Sort.
     *
     * @param string $sort
     *
     * @return array
     */
    public function sortOrder(string $sort): array
    {
        $sortOrder = [];

        if (is_string($sort)) {
            $sort = explode(',', $sort);
        }

        foreach ($sort as $sortName) {
            if ($sortName && $sortName[0] == '-') {
                $sortOrder[substr($sortName, 1)] = 'DESC';
            } else {
                $sortOrder[$sortName] = 'ASC';
            }
        }

        return $sortOrder;
    }

    /**
     * Filter.
     *
     * @param string $filter
     *
     * @return array
     */
    public function filterData(string $filter): array
    {
        $filterData = [];

        if (is_string($filter)) {
            $filter = explode(',', $filter);
        }

        foreach ($filter as $filterItem) {
            [$field, $value] = explode(':', $filterItem);
            $filterData[$field] = $value;
        }

        return $filterData;
    }
}
