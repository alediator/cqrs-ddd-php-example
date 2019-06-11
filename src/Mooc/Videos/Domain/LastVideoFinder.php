<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\Criteria\Filters;
use CodelyTv\Shared\Domain\Criteria\Order;
use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Shared\Domain\Criteria\OrderType;

final class LastVideoFinder
{
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ?Video
    {
        $video = $this->findLastVideo();

        return $video;
    }

    private function findLastVideo(): ?Video
    {
        $criteria = new Criteria(
            Filters::fromValues([]),
            new Order(new OrderBy('occurredOn'), new OrderType(OrderType::DESC)),
            0, 1
        );

        $videos = $this->repository->searchByCriteria($criteria);
        if (empty($videos)) {
            throw new NoVideoAvailable();
        } else {
            return $videos[0];
        }
    }
}