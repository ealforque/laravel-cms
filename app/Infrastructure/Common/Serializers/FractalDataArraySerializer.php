<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class FractalDataArraySerializer extends ArraySerializer
{
    /**
     * Merge includes.
     *
     * @param mixed $transformedData
     * @param mixed $includedData
     *
     * @return mixed
     */
    public function mergeIncludes($transformedData, $includedData): array
    {
        $includedData = array_map(function ($include) {
            if (isset($include['data'])) {
                // @codeCoverageIgnoreStart
                return $include['data'];
                // @codeCoverageIgnoreEnd
            }

            return $include;
        }, $includedData);

        return parent::mergeIncludes($transformedData, $includedData);
    }
}
