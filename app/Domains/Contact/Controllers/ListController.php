<?php

declare(strict_types=1);

namespace App\Domains\Contact\Controllers;

use App\Domains\Contact\DTOs\ContactListDTO;
use App\Domains\Contact\Interfaces\ContactServiceInterface;
use App\Infrastructure\Base\Controllers\Controller;
use App\Infrastructure\Common\Validators\PaginatorValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * ContactService.
     *
     * @var ContactServiceInterface
     */
    private ContactServiceInterface $contactService;

    /**
     * ListController constructor.
     *
     * @param ContactServiceInterface $contactService
     */
    public function __construct(ContactServiceInterface $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Handles the GET /contacts endpoint.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, [
            PaginatorValidator::rules(),
        ]);

        $dto = new ContactListDTO($request);
        $response = $this->contactService->getContacts($dto);

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }
}
