<?php

namespace App\Infrastructure\Common\Traits;

use App\Infrastructure\Base\Interfaces\RUIDModelInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait RUIDTrait
{
    /**
     * Prefix.
     *
     * @var string
     */
    protected string $prefix;

    /**
     * Get environment prefix.
     *
     * @return string
     */
    protected static function getEnvPrefix(): string
    {
        static $prefix;

        if (!is_string($prefix)) {
            $prefix = Config::get('ruid.prefix') ?? '';
        }

        return $prefix;
    }

    /**
     * Get model by RUID.
     *
     * @param string $ruid
     *
     * @return RUIDModelInterface|null
     */
    public static function getByRUID(string $ruid): ?RUIDModelInterface
    {
        return self::getBuilderByRUID($ruid)->first();
    }

    /**
     * Get builder by RUID.
     *
     * @param string $ruid
     *
     * @return Builder
     */
    private static function getBuilderByRUID(string $ruid): Builder
    {
        return self::where(DB::raw('BINARY `ruid`'), $ruid);
    }

    /**
     * Mutate model RUID to concatenate env prefix and resource prefix.
     *
     * @return RUIDModelInterface|null
     */
    protected function ruid(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => self::getEnvPrefix() . self::RUID_PREFIX . $value,
        );
    }
}
