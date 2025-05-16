<?php
declare(strict_types=1);

namespace Laenen\CacheImprovement\Core\Content\Framework\Adapter\Asset;

use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\Asset\VersionStrategy\VersionStrategyInterface;

readonly class EmptyVersionStrategy implements VersionStrategyInterface
{
    public function __construct(
        private VersionStrategyInterface $decorated,
        private SystemConfigService $systemConfigService,
    ) {
    }

    public function getVersion(string $path): string
    {
        try {
            if ($this->systemConfigService->get('LaenenCacheImprovement.config.enableAssetVersionStrategy')) {
                return '';
            }
        } catch (\Throwable $e) {
            //
        }

        return $this->decorated->getVersion($path);
    }

    public function applyVersion(string $path): string
    {
        try {
            if ($this->systemConfigService->get('LaenenCacheImprovement.config.enableAssetVersionStrategy')) {
                return $path;
            }
        } catch (\Throwable $e) {
            //
        }

        return $this->decorated->applyVersion($path);
    }
}
