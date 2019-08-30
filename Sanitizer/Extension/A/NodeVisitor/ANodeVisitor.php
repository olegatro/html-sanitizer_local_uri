<?php

namespace Sanitizer\Extension\A\NodeVisitor;

use HtmlSanitizer\Model\Cursor;
use HtmlSanitizer\Node\NodeInterface;
use HtmlSanitizer\Visitor\AbstractNodeVisitor;
use HtmlSanitizer\Visitor\HasChildrenNodeVisitorTrait;
use HtmlSanitizer\Visitor\NamedNodeVisitorInterface;
use Sanitizer\Extension\A\Node\ANode;
use Sanitizer\Extension\A\Sanitizer\AHrefSanitizer;

final class ANodeVisitor extends AbstractNodeVisitor implements NamedNodeVisitorInterface
{
    use HasChildrenNodeVisitorTrait;

    private $sanitizer;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->sanitizer = new AHrefSanitizer(
            $this->config['allowed_hosts'],
            $this->config['allow_mailto'],
            $this->config['allow_local_uri'],
            $this->config['force_https']
        );
    }

    protected function getDomNodeName(): string
    {
        return 'a';
    }

    public function getDefaultAllowedAttributes(): array
    {
        return ['href', 'title'];
    }

    public function getDefaultConfiguration(): array
    {
        return [
            'allowed_hosts'   => null,
            'allow_mailto'    => true,
            'allow_local_uri' => true,
            'force_https'     => false,
        ];
    }

    protected function createNode(\DOMNode $domNode, Cursor $cursor): NodeInterface
    {
        $node = new ANode($cursor->node);
        $node->setAttribute('href', $this->sanitizer->sanitize($this->getAttribute($domNode, 'href')));
        return $node;
    }
}
