<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use pocketmine\plugin\PluginBase;
use Symfony\Component\Finder\SplFileInfo;
use vennv\vapm\Error;
use vennv\vapm\FiberManager;
use vennv\vapm\Async;
use vennv\vapm\Stream;
use vennv\vapm\VapmPMMP;
use function count;
use function file;
use function is_array;
use function str_word_count;
use function strlen;

class Counter {

	/**
	 * Get folder information for all files in a directory with a given extension.
	 *
	 * @param PluginBase $plugin  	The plugin to get the folder info for.
	 * @param string $dir       	The directory to scan.
	 * @param string $extension 	The file extension to filter by.
	 * @return Async
	 */
	public static function getFolderInfo(PluginBase $plugin, string $dir, string $extension, bool $totalFilesT = true, bool $totalLinesT = true, bool $totalWordsT = true, bool $totalCharsT = true) : Async {
		VapmPMMP::init($plugin);

		return new Async(
			/** @return array{"totalFiles": int, "totalLines": int, "totalWords": int, "totalChars": int} An array of file information. */
			function () use ($dir, $extension, $totalFilesT, $totalLinesT, $totalWordsT, $totalCharsT) : array {
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

							FiberManager::wait();
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

							$content = Async::await(Stream::read($txtFile));
							if ($content !== Error::UNABLE_TO_OPEN_FILE && is_string($content)) {
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

				return [
					"totalFiles" => count($txtFiles),
					"totalLines" => $totalLines,
					"totalWords" => $totalWords,
					"totalChars" => $totalChars
				];
			}
		);
	}
}
