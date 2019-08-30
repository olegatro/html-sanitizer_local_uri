<?php

namespace Sanitizer\Extension\A\Sanitizer;

use HtmlSanitizer\Sanitizer\UrlSanitizerTrait;

final class AHrefSanitizer
{
    use UrlSanitizerTrait;

    private $allowedHosts;
    private $allowMailTo;
    private $allowLocalUri;
    private $forceHttps;

    public function __construct(?array $allowedHosts, bool $allowMailTo, bool $allowLocalUri, bool $forceHttps)
    {
        $this->allowedHosts = $allowedHosts;
        $this->allowMailTo = $allowMailTo;
        $this->allowLocalUri = $allowLocalUri;
        $this->forceHttps = $forceHttps;
    }

    public function sanitize(?string $input): ?string
    {
        $allowedSchemes = ['http', 'https'];
        $allowedHosts = $this->allowedHosts;

        if ($this->allowMailTo) {
            $allowedSchemes[] = 'mailto';
            if (\is_array($this->allowedHosts)) {
                $allowedHosts[] = null;
            }
        }

        if ($this->allowLocalUri) {
            $allowedSchemes[] = null;
            if (null !== $allowedHosts) {
                $allowedHosts[] = null;
            }
        }

        if (!$sanitized = $this->sanitizeUrl($input, $allowedSchemes, $allowedHosts, $this->forceHttps)) {
            return null;
        }
        // Basic validation that it's an e-mail
        if (0 === strpos($sanitized, 'mailto:') && (false === strpos($sanitized, '@') || false === strpos($sanitized, '.'))) {
            return null;
        }
        return $sanitized;
    }
}
