# Pro patterns

Each `*.php` file in this folder returns a list of pattern arrays. The Pattern Library lists them through `GET /sydney/v1/pro-patterns`, locked on free sites. They are never passed to `register_block_pattern()`.

```php
return array(
	array(
		'name'       => 'sydney-pro/pricing-1',
		'title'      => __( 'Pricing 3', 'sydney' ),
		'categories' => array( 'sydney-pricing' ),
		'keywords'   => array( 'pricing' ),
		'content'    => '<!-- wp:group ... /-->',
	),
);
```

See `Sydney_Pattern_Library::get_pro_patterns()`.
