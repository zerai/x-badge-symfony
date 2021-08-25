<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\BadgeResponseFactory;
use Badge\Application\PortIn\CreateLicenseBadge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LicenseController extends AbstractController
{
    private CreateLicenseBadge $useCase;

    private BadgeResponseFactory  $responseFactory;

    /**
     * @param CreateLicenseBadge $useCase
     * @param BadgeResponseFactory $responseFactory
     */
    public function __construct(CreateLicenseBadge $useCase, BadgeResponseFactory $responseFactory)
    {
        $this->useCase = $useCase;
        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): Response
    {
        $repository = $request->get('repository');

        $image = $this->useCase->createLicenseBadge($repository);

        return $this->responseFactory->createFromImage($image, 200);
    }
}
