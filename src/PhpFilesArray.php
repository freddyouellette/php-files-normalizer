<?php

namespace freddyouellette\PhpFilesNormalizer;

require_once __DIR__.'/PhpFilesArray_Interface.php';

class PhpFilesArray implements \freddyouellette\PhpFilesNormalizer\PhpFilesArray_Interface
{
	public static function normalize(Array $php_files_array, Array $output = []) 
	{
		foreach($php_files_array as $key => $value) {
			// start the recursion by adding the first layer of the array
			self::addNamespace($output, $key, $value);
		}
		
		return $output;
	}
	
	// recursive function used above
	private static function addNamespace(&$base, $key, $value, $fileKey = NULL) {
		if(is_array($value)) {
			if(empty($base[$key])) {
				$base[$key] = [];
			}
			if(isset($value['name'], $value['type'], $value['tmp_name'], $value['error'], $value['size'])) {
				// this is the start of the files section
				foreach($value as $fileKey => $fileInner) {
					if(is_array($fileInner)) {
						foreach($fileInner as $fileInnerKey => $fileInnerValue) {
							self::addNamespace($base[$key], $fileInnerKey, $fileInnerValue, $fileKey);
						}
					} else {
						$base[$key][0][$fileKey] = $fileInner;
					}
				}
			} else {
				foreach($value as $innerKey => $innerValue) {
					self::addNamespace($base[$key], $innerKey, $innerValue, $fileKey);
				}
			}
		} else {
			if($fileKey) {
				$base[$key][$fileKey] = $value;
			} else {
				$base[$key] = $value;
			}
		}
	}
}