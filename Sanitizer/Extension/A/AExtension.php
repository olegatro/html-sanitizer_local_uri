<?php

namespace Sanitizer\Extension\A;

use HtmlSanitizer\Extension\ExtensionInterface;
use Sanitizer\Extension\A\NodeVisitor\ANodeVisitor;

final class AExtension implements ExtensionInterface
{
    public function getName(): string
    {
        return 'custom-a';
    }

    public function createNodeVisitors(array $config = []): array
    {
        return [
            'a' => new ANodeVisitor($config['tags']['a'] ?? [])
        ];
    }


}
