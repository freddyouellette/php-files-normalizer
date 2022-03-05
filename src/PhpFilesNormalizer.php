<?php

namespace freddyouellette\PhpFilesNormalizer;

require_once __DIR__.'/PhpFilesNormalizer_Interface.php';

class PhpFilesNormalizer implements \freddyouellette\PhpFilesNormalizer\PhpFilesNormalizer_Interface
{
	/**
	 * Turns a $_FILES array (or an array structured like $_FILES) into a much friendlier format.
	 * 
	 * @param $phpFilesArray should be $_FILES
	 * @param $output optional array to merge with the files array
	 */
	public static function normalize(Array $php_files_array, Array $output = []) {
		foreach($php_files_array as $key => $value) {
			// start the recursion by adding the first layer of the array
			self::addNamespace($output, $key, $value);
		}
		
		return $output;
	}
	
	/**
	 * Add a namespace to $base (recursive function)
	 * @private
	 */
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
				if(is_numeric($key)) {
					// this is multiple files
					$base[$key][$fileKey] = $value;
				} else {
					$base[$key][0][$fileKey] = $value;
				}
			} else {
				$base[$key] = $value;
			}
		}
	}
}