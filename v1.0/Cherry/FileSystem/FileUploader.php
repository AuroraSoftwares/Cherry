<?php
    require_once 'FileManager.php';
    	/**
	 * <b>FILE : </b>FileUploader.php<br>
     	* <b>COPYRIGHT : </b>©2021 | Aurora Softwares<br>
     	* <b>VERSION : </b>1.0
	*/
	class FileUploader
	{
		private $iNm;
		private $tmp;
		private $sz;

		/**
		 * Instantiates the class FileUploader.
		 * @return FileUploader
		 */
		function __construct($fileInputName)
		{
			$this -> iNm = $_FILES[$fileInputName]["name"];
			$this -> tmp = $_FILES[$fileInputName]["tmp_name"];
			$this -> sz = $_FILES[$fileInputName]["size"];
		}

		/**
		 * Gets the filename.
		 * @return string
		 */
		function getFilename()
		{
		    return($this -> iNm);
		}

		/**
		 * Gets the file extension.
		 * @return string
		 */
		function getFileExtension()
		{
		    $file = new FileManager($this -> iNm);
		    return($file->getFileExtension());
		}

		/**
		 * Gets the file size after formating into specified unit.
		 * @return string
		 */
		function getFileSize($unit, $showUnit)
		{
			$szz = "";
			if($unit===null || $unit==="B" || $unit==="b")
			{
				$szz = $this->sz;
			}
			else if($unit==="k" || $unit==="K")
			{
				$szz = round($this->sz/1024);
			}
			else if($unit==="m" || $unit==="M")
			{
				$szz = round($this->sz/(1024*1024));
			}
			else if($unit==="g" || $unit==="G")
			{
				$szz = round($this->sz/(1024*1024*1024));
			}

			if(($showUnit===true) && ($unit==="k" || $unit==="K" || $unit==="m" || $unit==="M" || $unit==="g" || $unit==="G"))
			{
				$szz = $szz." ".strtoupper($unit)."b";
			}
			else if(($showUnit===true) && ($unit===null || $unit==="B" || $unit==="b"))
			{
				$szz = $szz." B";
			}
			return($szz);
		}

		/**
		 * Uploads the file to a specified path.
		 * @return bool
		 */
		function upload($destinationDirectoryPath, $filname)
		{
			if($this -> iNm !== null)
			{
			    return(move_uploaded_file($this -> tmp, $destinationDirectoryPath.'/'.$filname));
			}
		}
	}
?>
