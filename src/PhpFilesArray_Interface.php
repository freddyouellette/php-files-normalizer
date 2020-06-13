<?php

namespace freddyouellette\PhpFilesNormalizer;

interface PhpFilesArray_Interface
{
	/**
	 * Normalizes the php $_FILES array to a friendlier array, based on the names of the file inputs 
	 * 	on the frontend. The resulting array will be possibly multi-layered (based on file input 
	 * 	names), and will treat all file inputs as if they allowed multiple files (each "file" 
	 * 	namespace will be an array of files, instead of just one file).
	 * 
	 * @param array should be the global $_FILES array, but can also be another array in the same format
	 * @param array existing array to attach the new files to (optional)
	 * @return array friendlier array of files
	 */
	public static function normalize(Array $php_files_array, Array $output = []);
}