<?php

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateTotalDownloadsBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TotalDownloadsController extends AbstractController
{
    private CreateTotalDownloadsBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateTotalDownloadsBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createTotalDownloadsBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}