```php

$builder = new SanitizerBuilder();
$builder->registerExtension(new BasicExtension());
$builder->registerExtension(new ListExtension());
$builder->registerExtension(new TableExtension());
$builder->registerExtension(new IframeExtension());
$builder->registerExtension(new ImageExtension());
$builder->registerExtension(new AExtension());

$sanitizer = $builder->build(['extensions' => ['basic', 'list', 'table', 'custom-image', 'custom-a']]);

```