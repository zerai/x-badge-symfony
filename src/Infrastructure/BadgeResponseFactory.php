<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Badge\Application\Image;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class BadgeResponseFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public static function createFromImage(Image $image, int $status, int $maxage = 3600, int $smaxage = 3600): Response
    {
        $response = new Response((string) $image, $status);

        $response->headers->set('Content-Type', 'image/svg+xml;charset=utf-8');
        $contentDisposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $image->getFileName());
        $response->headers->set('Content-Disposition', $contentDisposition);

        $response->setMaxAge($maxage);
        $response->setSharedMaxAge($smaxage);
        $response->setPublic();

        return $response;
    }
}
