<?php

ini_set('display_errors', true);

require_once __DIR__.'/../src/PhpFilesNormalizer.php';

if($_FILES) {
	$parsed = \freddyouellette\PhpFilesNormalizer\PhpFilesNormalizer::normalize($_FILES);
	
	echo '<pre>';
	echo '//////////////////////////////////////////////////////////////////////////////'.PHP_EOL;
	echo '// UNALTERED PHP $_FILES ARRAY'.PHP_EOL;
	echo '// SEE BELOW FOR NORMALIZED VERSION'.PHP_EOL;
	echo '//////////////////////////////////////////////////////////////////////////////'.PHP_EOL;
	var_export($_FILES);
	
	echo PHP_EOL.PHP_EOL;
	echo '//////////////////////////////////////////////////////////////////////////////'.PHP_EOL;
	echo '// NORMALIZED WITH PhpFilesNormalizer'.PHP_EOL;
	echo '//////////////////////////////////////////////////////////////////////////////'.PHP_EOL;
	var_export($parsed);
	
	echo '</pre>';
	echo '<hr/>';
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PhpFilesNormalizer</title>
	</head>
	<body>
		<form action="" method="post" enctype="multipart/form-data">
			<h2>Example 1: Single File Upload</h2>
			<p>
				<b>Click "Submit" to see the Normalizer in action</b>
			</p>
			<div>single <input type="file" name="single"/></div>
			<div><input type="submit" value="Submit"/></div>
		</form>
		<hr/>
		
		<form action="" method="post" enctype="multipart/form-data">
			<h2>Example 2: Multiple File Upload</h2>
			<p>
				<b>Upload multiple files to the input and Click "Submit" to see the Normalizer in action</b>
			</p>
			<div>multiple_files[] <input type="file" name="multiple_files[]" multiple/></div>
			<div><input type="submit" value="Submit"/></div>
		</form>
		<hr/>
		
		<form action="" method="post" enctype="multipart/form-data">
			<h2>Example 3: Simple Nested File</h2>
			<p>
				<b>Click "Submit" to see the Normalizer in action</b>
			</p>
			<div>nested[][file] <input type="file" name="nested[][file]"/></div>
			<div><input type="submit" value="Submit"/></div>
		</form>
		<hr/>
		
		<form action="" method="post" enctype="multipart/form-data">
			<h2>Example 4: Nested Multiple</h2>
			<p>
				<b>Select multiple files to the input and click "Submit" to see the Normalizer in action</b>
			</p>
			<div>nested[0][files][] <input type="file" name="nested[0][files][]" multiple/></div>
			<div><input type="submit" value="Submit"/></div>
		</form>
		<hr/>
		
		<form action="" method="post" enctype="multipart/form-data">
			<h2>Example 5: Complex Nested Files</h2>
			<p>
				<b>Select multiple files for each input and click "Submit" to see the Normalizer in action</b>
			</p>
			<div>nested[0][files][] <input type="file" name="nested[0][files][]" multiple/></div>
			<div>nested[0][other][file] <input type="file" name="nested[0][other][file]"/></div>
			<div>nested[1][files][] <input type="file" name="nested[1][files][]" multiple/></div>
			<div>nested[1][other][file] <input type="file" name="nested[1][other][file]"/></div>
			<div><input type="submit" value="Submit"/></div>
		</form>
		<hr/>
	</body>
</html>