<?php
	namespace Cherry\Utils;

	use Cherry\Core;
	Core::importSingleFile(dirname(dirname(__FILE__)).'/FileSystem/FileManager.php');

	/**
	 * <b>FILE : </b>ImageConverter.php<br>
	 * <b>COPYRIGHT : </b>©2020 | AuroraSoftwares<br>
     * <b>VERSION : </b>1.0
	 */

	class ImageConverter
	{
		/**
		 * Converts JPEG, JPG, PNG and GIF images into JPG file.
		 * @param string $sourceFilePath
		 * @param string $destinationDirectoryPath
		 * @param string $outputFilename
		 * @param int $quality (0-100)
		 */
		public static function convertToJpg($sourceFilePath, $destinationDirectoryPath, $outputFilename, $quality)
		{
			$fm = new \FileManager($sourceFilePath);
			if(strtolower($fm->getFileExtension()) === 'jpg' || strtolower($fm->getFileExtension()) === 'jpeg')
			{
				$img = imagecreatefromjpeg($sourceFilePath);
			}
			else if(strtolower($fm->getFileExtension()) === 'png')
			{
				$img = imagecreatefrompng($sourceFilePath);
			}
			else if(strtolower($fm->getFileExtension()) === 'gif')
			{
				$img = imagecreatefromgif($sourceFilePath);
			}
			
			$bg = imagecreatetruecolor(imagesx($img), imagesy($img));
			imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
			imagealphablending($bg, TRUE);
			imagecopy($bg, $img, 0, 0, 0, 0, imagesx($img), imagesy($img));
			imagedestroy($img);
			imagejpeg($bg, $destinationDirectoryPath.'/'.$outputFilename.'.jpg', $quality);
			imagedestroy($bg);
		}

		/**
		 * Converts JPEG, JPG, PNG and GIF images into PNG file.
		 * @param string $sourceFilePath
		 * @param string $destinationDirectoryPath
		 * @param string $outputFilename
		 * @param int $quality (0-9)
		 */
		public static function convertToPng($sourceFilePath, $destinationDirectoryPath, $outputFilename, $quality)
		{
			$fm = new \FileManager($sourceFilePath);
			if(strtolower($fm->getFileExtension()) === 'jpg' || strtolower($fm->getFileExtension()) === 'jpeg')
			{
				$img = imagecreatefromjpeg($sourceFilePath);
			}
			else if(strtolower($fm->getFileExtension()) === 'png')
			{
				$img = imagecreatefrompng($sourceFilePath);
			}
			else if(strtolower($fm->getFileExtension()) === 'gif')
			{
				$img = imagecreatefromgif($sourceFilePath);
			}
			imagepng($img, $destinationDirectoryPath.'/'.$outputFilename.'.png', $quality);
			imagedestroy($img);
		}
	}
?>