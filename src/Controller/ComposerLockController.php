<?php

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateComposerLockBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ComposerLockController extends AbstractController
{
    private CreateComposerLockBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateComposerLockBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createComposerLockBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}