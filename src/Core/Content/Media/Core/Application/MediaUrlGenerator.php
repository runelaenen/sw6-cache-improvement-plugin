<?php
declare(strict_types=1);

namespace Laenen\CacheImprovement\Core\Content\Media\Core\Application;

use Shopware\Core\Content\Media\Core\Application\AbstractMediaUrlGenerator;
use Shopware\Core\Content\Media\Core\Params\UrlParams;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class MediaUrlGenerator extends AbstractMediaUrlGenerator
{
    public function __construct(
        private readonly AbstractMediaUrlGenerator $decorated,
        private readonly SystemConfigService $systemConfigService,
    ) {
    }

    public function generate(array $paths): array
    {
        if ($this->systemConfigService->get('LaenenCacheImprovement.config.enableMediaUrlGenerator')) {
            // Removes the 'updatedAt' so the core MediaUrlGenerator does not add the `ts` querystring
            foreach ($paths as $key => $path) {
                $paths[$key] = new UrlParams(
                    $path->id,
                    $path->source,
                    $path->path
                );
            }
        }

        return $this->decorated->generate($paths);
    }
}
