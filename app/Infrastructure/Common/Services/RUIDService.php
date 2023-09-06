<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Services;

use App\Infrastructure\Base\Interfaces\RUIDModelInterface;
use App\Infrastructure\Common\Interfaces\RUIDServiceInterface;
use Hidehalo\Nanoid\Client;

class RUIDService implements RUIDServiceInterface
{
    /**
     * @const string Available chars for nanoid
     *
     * @see https://github.com/CyberAP/nanoid-dictionary#nolookalikes
     */
    public const ALPHABET = '346789ABCDEFGHJKLMNPQRTUVWXYabcdefghijkmnpqrtwxyz';

    /**
     * @const int Length of ruid without prefix and table
     */
    public const LENGTH = 16;

    /**
     * Nanoid client.
     *
     * @var Client
     */
    private $nanoidClient;

    /**
     * RUID service constructor.
     *
     * @param Client $nanoidClient
     */
    public function __construct(Client $nanoidClient)
    {
        $this->nanoidClient = $nanoidClient;
    }

    /**
     * Generate.
     *
     * @param RUIDModelInterface $model
     *
     * @return string
     */
    public function generate(RUIDModelInterface $model): string
    {
        do {
            $id = $this->nanoidClient->formattedId(self::ALPHABET, self::LENGTH);
        } while ($model::getByRUID($id));

        return $id;
    }
}
