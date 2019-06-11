<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class NoVideoAvailable extends DomainError
{
    public function errorCode(): string
    {
        return 'no_video_available';
    }

    protected function errorMessage(): string
    {
        return sprintf('No video available');
    }
}