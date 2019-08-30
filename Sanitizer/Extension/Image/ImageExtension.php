<?php

namespace Sanitizer\Extension\Image;

use HtmlSanitizer\Extension\ExtensionInterface;
use Sanitizer\Extension\Image\NodeVisitor\ImgNodeVisitor;

final class ImageExtension implements ExtensionInterface
{
    public function getName(): string
    {
        return 'custom-image';
    }

    public function createNodeVisitors(array $config = []): array
    {
        return [
            'img' => new ImgNodeVisitor($config['tags']['img'] ?? [])
        ];
    }


}
