```php

use HtmlSanitizer\Extension\Basic\BasicExtension;
use HtmlSanitizer\Extension\Iframe\IframeExtension;
use HtmlSanitizer\Extension\Listing\ListExtension;
use HtmlSanitizer\Extension\Table\TableExtension;
use Sanitizer\Extension\Image\ImageExtension;
use Sanitizer\Extension\A\AExtension;
use HtmlSanitizer\SanitizerBuilder;


$builder = new SanitizerBuilder();
$builder->registerExtension(new BasicExtension());
$builder->registerExtension(new ListExtension());
$builder->registerExtension(new TableExtension());
$builder->registerExtension(new IframeExtension());
$builder->registerExtension(new ImageExtension());
$builder->registerExtension(new AExtension());

$sanitizer = $builder->build(['extensions' => ['basic', 'list', 'table', 'custom-image', 'custom-a']]);

```