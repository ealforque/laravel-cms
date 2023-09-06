<?php

declare(strict_types=1);

namespace App\Domains\Contact\Interfaces;

use App\Domains\Contact\DTOs\ContactListDTO;
use App\Infrastructure\Common\Interfaces\FractalServiceInterface;
use App\Infrastructure\Common\Interfaces\PaginatorServiceInterface;

interface ContactServiceInterface
{
    /**
     * Contact service constructor definition.
     *
     * @param ContactRepositoryInterface  $contactRepository
     * @param PaginatorServiceInterface   $paginator
     * @param ContactTransformerInterface $contactTransformer
     * @param FractalServiceInterface     $fractal
     */
    public function __construct(
        ContactRepositoryInterface $contactRepository,
        PaginatorServiceInterface $paginator,
        ContactTransformerInterface $contactTransformer,
        FractalServiceInterface $fractal
    );

    /**
     * Get contacts method definition.
     *
     * @param ContactListDTO $dto
     *
     * @return array
     */
    public function getContacts(ContactListDTO $dto): array;
}
