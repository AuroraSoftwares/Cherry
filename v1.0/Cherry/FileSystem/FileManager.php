<?php
	/**
	 * <b>FILE : </b>FileManager.php<br>
     * <b>COPYRIGHT : </b>©2021 | Aurora Softwares<br>
     * <b>VERSION : </b>1.0
	 */

	class FileManager
	{
		private $pth;
		private $urlPth;
		private $fw;

		/**
		 * Instantiates the class FileManager.
		 * @return FileManager
		 */
		function __construct($filepath)
		{
			$this -> pth = $filepath;
			$this -> urlPth = strlen(strstr($filepath, "http:"))>0 || strlen(strstr($filepath, "https:"))>0;
            $this -> fw = false;
		}

		/**
		 * Checks the existence of file.
		 * @return bool
		 */
		function isFileExists()
		{
			return(file_exists($this -> pth));
		}

		/**
		 * Creates a folder.
		 * @return bool
		 */
		function createFolder()
		{
			if(!file_exists($this->pth) && $this->urlPth===false)
			{
				return(mkdir($this->pth, 07777));
			}
		}

		/**
		 * Creates an empty file.
		 * @return bool
		 */
		function createFile()
		{
			if(!file_exists($this->pth) && $this->urlPth===false)
			{
				$f = fopen($this->pth, "w");
				fwrite($f, "");
				fclose($f);
				return(true);
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Writes contents to the file.
		 * @return bool
		 */
		function writeToFile($contents)
		{
		    if($this->urlPth===false)
		    {
    			if(file_exists($this->pth))
    			{
    				$f = fopen($this->pth, "w");
    				fwrite($f, $contents);
    				fclose($f);
    				$this -> fw = true;
    			}
    			else
    			{
    			    if($this->createFile())
    			    {
    			        $f2 = fopen($this->pth, "w");
    			        fwrite($f2, $contents);
    			        fclose($f2);
    			        $this -> fw = true;
    			    }
    			    else
    			    {
    			        $this -> fw = false;
    			    }
    			}
		    }
		    else
		    {
		        $this -> fw = false;
		    }
		    return($this -> fw);
		}

		/**
		 * Deletes a file or a folder.
		 * @return bool
		 */
		function delete()
		{
			if(file_exists($this->pth) && $this->urlPth===false)
			{
				if(is_dir($this->pth))
				{
					return(rmdir($this->pth));
				}
				else
				{
					return(unlink($this->pth));
				}
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Copies file or folder to a specified folder.
		 * @return bool
		 */
		function copyToDirectory($directoryPath)
		{
			if(file_exists($this->pth) && file_exists($directoryPath) && $this->urlPth===false)
			{
				return(copy($this->pth, $directoryPath."/".pathinfo($this->pth, PATHINFO_FILENAME).".".pathinfo($this->pth, PATHINFO_EXTENSION)));
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Adds contents to the file after its pre-existing contents.
		 */
		function appendTextContents($contents)
		{
			if(file_exists($this->pth) && $this->urlPth===false)
			{
				$dat = file_get_contents($this->pth);
				$f = fopen($this->pth, "w");
				fwrite($f, $dat."\n".$contents);
				fclose($f);
			}
		}

		/**
		 * Plays audio if the specified file is a web supported audio file.
		 */
		function readAsAudio($visible)
		{
			if($visible)
			{
				$dsp = '';
			}
			else
			{
				$dsp = 'width:0; height:0; display:none;';
			}
			if($this->urlPth===true || file_exists($this->pth))
			{
				echo "\n<audio style='".$dsp."' src='".$this->pth."' autoplay='true' controls></audio>\n";
			}
		}

		/**
		 * Plays video if the specified file is a web supported video file.
		 */
		function readAsVideo($width)
		{
			if($this->urlPth===true || file_exists($this->pth))
			{
				echo "\n<video width='".$width."' src='".$this->pth."' autoplay='true' style='min-width:30%; border-radius:8px; box-shadow:rgba(0, 0, 0, 0.7) -6px 6px 8px;' controls></video>\n";
			}
		}

		/**
		 * Displays the image if the specified file is a web supported image file.
		 */
		function readAsImage($width)
		{
			if($this->urlPth===true || file_exists($this->pth))
			{
				echo "\n<a href='".$this->pth."'>\n\t<img width='".$width."' src='".$this->pth."' style='-min-height:auto; border-radius:8px; box-shadow:rgba(0, 0, 0, 0.7) -6px 6px 8px;'>\n</a>\n";
			}
		}

		/**
		 * Displays the contents of the file as text.
		 */
		function readAsText($textSize)
		{
			if($this->urlPth===true || file_exists($this->pth))
			{
				echo file_get_contents($this->pth);
			}
		}

		/**
		 * Gets the contents of the file as text.
		 * @return string
		 */
		function getTextContent()
		{
			$cont = "";
			if($this->urlPth===true || file_exists($this->pth))
			{
				$cont = file_get_contents($this->pth);
			}
			else
			{
				$cont = null;
			}
			return($cont);
		}

		/**
		 * Gets the path of the specified file.
		 * @return string
		 */
		function getFilePath()
		{
			return($this->pth);
		}

		/**
		 * Gets the filename of the specified file.
		 * @return string
		 */
		function getFilename()
		{
			$fnm = pathinfo($this->pth, PATHINFO_FILENAME).".".pathinfo($this->pth, PATHINFO_EXTENSION);
			return($fnm);
		}

		/**
		 * Gets the filename without file-extension of the specified file.
		 * @return string
		 */
		function getFilenameWithoutExtension()
		{
			$fnms = pathinfo($this->pth, PATHINFO_FILENAME);
			return($fnms);
		}

		/**
		 * Gets the filetype-extension of the specified file.
		 * @return string
		 */
		function getFileExtension()
		{
			$ext = pathinfo($this->pth, PATHINFO_EXTENSION);
			return($ext);
		}

		/**
		 * Gets the file size after formating into specified unit.
		 * @return string
		 */
		function getFileSize($unit, $showUnit)
		{
			$sz = "";
			if(!file_exists($this->pth))
			{
				if($unit===null || $unit==="B" || $unit==="b")
				{
					$sz = filesize($this->pth);
				}
				else if($unit==="k" || $unit==="K")
				{
					$sz = filesize($this->pth)/1024;
				}
				else if($unit==="m" || $unit==="M")
				{
					$sz = filesize($this->pth)/(1024*1024);
				}
				else if($unit==="g" || $unit==="G")
				{
					$sz = filesize($this->pth)/(1024*1024*1024);
				}

				if(($showUnit===true) && ($unit==="k" || $unit==="K" || $unit==="m" || $unit==="M" || $unit==="g" || $unit==="G"))
				{
					$sz = $sz." ".strtoupper($unit)."b";
				}
				else if(($showUnit===true) && ($unit===null || $unit==="B" || $unit==="b"))
				{
					$sz = $sz." B";
				}
			}
			else
			{
				$sz = null;
			}
			return($sz);
		}
	}
?>
