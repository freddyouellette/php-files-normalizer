# PHP $_FILES Array Normalizer

$_FILES in PHP is not a friendly array, especially when POSTing multiple files or using file inputs with nested names like `layer[][file]`. The `PHP $_FILES Array Normalizer` will normalize the $_FILES array to the following format:

```
[
	'files' => [
		0 => [
			'name' => 'file1.png',
			'type' => 'image/png',
			'tmp_name' => '/tmp/phpxbbHdC',
			'error' => 0,
			'size' => 11393,
		],
		1 => [
			'name' => 'file2.png',
			'type' => 'image/png',
			'tmp_name' => '/tmp/phpajPldE',
			'error' => 0,
			'size' => 11393,
		],
	],
]
```
And if you are using nested file inputs with names like `layer[0][file]` and `layer[0][other][file]`, the format will be as follows:
```
[
	'layer' => [
		0 => [
			'file' => [
				0 => [
					'name' => 'file1.png',
					'type' => 'image/png',
					'tmp_name' => '/tmp/phpxbbHdC',
					'error' => 0,
					'size' => 11393,
				],
			],
			'other' => [
				'file' => [
					0 => [
						'name' => 'file1.png',
						'type' => 'image/png',
						'tmp_name' => '/tmp/phpxbbHdC',
						'error' => 0,
						'size' => 11393,
					],
				],
			],
		],
	],
]
```

Things to consider:
* The normalizer will __treat all file inputs as if they were `multiple`.__ That means that the final `files` layer will always be an array of files, even if only one file was POSTed.
* Don't forget to add the `multiple` attribute and `[]` to the end of your input name when you want multiple files.

# Usage
Install via composer:
```
composer require freddyouellette/php-files-normalizer
```

and in your php file:
```php
// require composer autoloader
require_once __DIR__.'/vendor/autoload.php';

// include the Normalizer namespace
use \freddyouellette\PhpFilesNormalizer\PhpFilesNormalizer;

// normalize the $_FILES array
$files = PhpFilesNormalizer::normalize($_FILES);
```

If you would rather merge the $_FILES array into an existing one, just pass the existing array as the second argument:
```php
$files = ['other-data' => 12345];
$files = PhpFilesNormalizer::normalize($_FILES, $files);
```
This can be useful to normalize all data passed from the frontend to a single array. Then your backend controllers can be passed a single array of data instead of having a direct dependency between the *controller* and the *data type* it relies on.
```php
$data = array_merge($_POST, $_GET);
$data = PhpFilesNormalizer::normalize($_FILES, $data);
// some controller which accepts data as an argument
$Controller->__invoke($data);
```

# Contributing
I encourage all issues to be submitted through the [**Issues** tab on GitHub](https://github.com/freddyouellette/php-files-normalizer/issues). Pull requests are welcome.