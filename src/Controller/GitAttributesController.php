<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateGitattributesBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GitAttributesController extends AbstractController
{
    private CreateGitattributesBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateGitattributesBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createGitattributesBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}
