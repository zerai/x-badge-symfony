<?php

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateMonthlyDownloadsBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MonthlyDownloadsController extends AbstractController
{
    private CreateMonthlyDownloadsBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateMonthlyDownloadsBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createMonthlyDownloadsBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}