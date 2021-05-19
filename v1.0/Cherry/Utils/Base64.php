<?php
	namespace Cherry\Utils;

	use Cherry\Core;
	Core::importSingleFile(dirname(dirname(__FILE__)).'/FileSystem/FileManager.php');

	/**
	 * <b>FILE : </b>Base64.php<br>
     	 * <b>COPYRIGHT : </b>©2021 | Aurora Softwares<br>
     	 * <b>VERSION : </b>1.0
	 */
	class Base64
	{
		/**
		 * Encodes the contents of a file into Base64 data.
		 * @return string
		 */
		public static function encodeFile($filepath)
		{
			$filetype = null;
			$data = null;
			$file = new \FileManager($filepath);
			$ext = $file->getFileExtension();

			if($ext==='png' || $ext==='jpg' || $ext==='jpeg' || $ext==='bmp' || $ext==='ico' || $ext==='gif')
			{
				$filetype = 'image';
				$bin = fread(fopen($filepath, "r"), filesize($filepath));
				return("data:".$filetype."/".$ext."; base64, ".base64_encode($bin));
			}
			else if($ext==='mp4')
			{
				$filetype = 'video';
				$bin = fread(fopen($filepath, "r"), filesize($filepath));
				return("data:".$filetype."/".$ext."; base64, ".base64_encode($bin));
			}
			else if($ext==='mp3' || $ext==='ogg' || $ext==='aac' || $ext==='wav')
			{
				$filetype = 'audio';
				$bin = fread(fopen($filepath, "r"), filesize($filepath));
				return("data:".$filetype."/".$ext."; base64, ".base64_encode($bin));
			}
			else if($ext==='mp3' || $ext==='ogg' || $ext==='aac' || $ext==='wav')
			{
				$filetype = 'audio';
				$bin = fread(fopen($filepath, "r"), filesize($filepath));
				return("data:".$filetype."/".$ext."; base64, ".base64_encode($bin));
			}
			else
			{
				return(base64_encode($file->getTextContent()));
			}
		}

		/**
		 * Encodes text into Base64 data.
		 * @return string
		 */
		public static function encodeText($text)
		{
			return(base64_encode($text));
		}

		/**
		 * Retrieves the original text contents from Base64 data.
		 * @return string
		 */
		public static function decodeText($base64Data)
		{
			return(base64_decode($base64Data));
		}
	}
?>
