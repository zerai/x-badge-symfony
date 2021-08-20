<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateDependentsBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DependentsController extends AbstractController
{
    private CreateDependentsBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateDependentsBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createDependentsBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}
