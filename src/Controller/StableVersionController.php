<?php

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateStableVersionBadge;
use Badge\Application\PortIn\CreateSuggestersBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StableVersionController extends AbstractController
{
    private CreateStableVersionBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateStableVersionBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createStableVersionBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}