<?php

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateUnstableVersionBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UnstableVersionController extends AbstractController
{
    private CreateUnstableVersionBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateUnstableVersionBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createUnstableVersionBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}