<?php

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateDailyDownloadsBadge;
use Badge\Application\PortIn\CreateMonthlyDownloadsBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DailyDownloadsController extends AbstractController
{
    private CreateDailyDownloadsBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    public function __construct(CreateDailyDownloadsBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;

        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createDailyDownloadsBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}