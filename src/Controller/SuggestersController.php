<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateSuggestersBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SuggestersController extends AbstractController
{
    private CreateSuggestersBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateSuggestersBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createSuggestersBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}
