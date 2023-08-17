<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use Symfony\Component\Finder\SplFileInfo;
use function count;
use function file;
use function file_get_contents;
use function is_array;
use function str_word_count;
use function strlen;

class Counter {

	/**
	 * Get folder information for all files in a directory with a given extension.
	 *
	 * @param string $dir       The directory to scan.
	 * @param string $extension The file extension to filter by.
	 * @return array{"totalFiles": int, "totalLines": int, "totalWords": int, "totalChars": int} An array of file information.
	 */
	public static function getFolderInfo(string $dir, string $extension, bool $totalFilesT = true, bool $totalLinesT = true, bool $totalWordsT = true, bool $totalCharsT = true) : array {
		$files = new \RecursiveIteratorIterator(
			iterator: new \RecursiveDirectoryIterator($dir),
			mode: \RecursiveIteratorIterator::CHILD_FIRST
		);
		$txtFiles = [];
		if ($totalFilesT) {
			foreach ($files as $file) {
				/** @var SplFileInfo $file */
				if ($file->isFile() && $file->getExtension() == $extension) {
					$txtFiles[] = $file->getRealPath();
				}
			}
		}
		$totalLines = 0;
		$totalWords = 0;
		$totalChars = 0;
		if ($totalLinesT || $totalWordsT || $totalCharsT) {
			foreach ($txtFiles as $txtFile) {
				if ($totalLinesT) {
					$value = file($txtFile);
					if (is_array($value)) {
						$totalLines += count($value);
					}
				}

				if ($totalWordsT || $totalChars) {
					$content = file_get_contents($txtFile);
					if ($content !== false) {
						if ($totalWordsT) {
							$totalWords += str_word_count($content);
						}
						if ($totalCharsT) {
							$totalChars += strlen($content);
						}
					}
				}
			}
		}
		/* TODO: Add more info */
		return [
			"totalFiles" => count($txtFiles),
			"totalLines" => $totalLines,
			"totalWords" => $totalWords,
			"totalChars" => $totalChars
		];
	}
}
