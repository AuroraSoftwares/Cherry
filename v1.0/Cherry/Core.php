<?php
	namespace Cherry;
	/**
	 * <b>FILE : </b>Core.php<br>
     	 * <b>COPYRIGHT : </b>©2021 | Aurora Softwares<br>
     	 * <b>VERSION : </b>1.0
	 */

	class Core
	{
		private $str_ar;

		/**
		 * Imports specified file.
		 */
		public static function importSingleFile($filepath)
		{
			include_once($filepath);
		}

		/**
		 * Imports all files of same type in a specified folder.
		 */
		public static function importAllFilesFrom($directoryPath, $fileTypeExtension)
		{
			foreach(glob($directoryPath.'/*.'.strtolower($fileTypeExtension)) as $fName)
			{
				if($fName !== $directoryPath.'/Cherry.php')
				{
					include_once($fName);
				}
			}
		}

		/**
		 * Splits a string;
		 * @return array
		 */
		public static function splitStringAt($delimiter, $string)
		{
			if($delimiter===null || $delimiter==='')
			{
				$str_ar = str_split($string);
			}
			else
			{
				$str_ar = explode($delimiter, $string);
			}
			return($str_ar);
		}

		/**
		 * Reverse the positions of characters in a string.
		 * @return string
		 */
		public static function reverseString($string)
		{
			return(strrev($string));
		}

		/**
		 * Checks the existence of specified portion within a string.
		 * @return bool
		 */
		public static function stringContains($string, $needle)
		{
			if(strpos($string, $needle))
			{
				return(true);
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Replaces a specified portion of a string with a string.
		 * @return string
		 */
		public static function findAndReplaceString($string, $find, $replacement)
		{
			return(str_replace($find, $replacement, $string));
		}

		/**
		 * Adds element to a specified array.
		 */
		public static function addArrayElement(array &$array, $element)
		{
			array_push($array, $element);
		}

		/**
		 * Checks the existence of an element within an array.
		 * @return bool
		 */
		public static function arrayElementExists(array &$array, $element)
		{
			return(in_array($element, $array));
		}

		/**
		 * Removes a specified element from an array.
		 */
		public static function removeArrayElement(array &$array, $element)
		{
			if(in_array($element, $array))
			{
				$index = array_search($element, $array);
				array_splice($array, $index, 1);
			}
		}

		/**
		 * Removes an element at specified index from an array.
		 */
		public static function removeArrayElementAt(array &$array, $index)
		{
			if($index < count($array))
			{
				array_splice($array, $index, 1);
			}
		}

		/**
		 * Gets the index number of a specified element of an array.
		 * @return int
		 */
		public static function getArrayElementKey(array &$array, $element)
		{
			return(array_search($element, $array));
		}

		/**
		 * Gets the elements of an array as string.
		 * @return string
		 */
		public static function getArrayAsString(array &$array, $elementSeparator)
		{
			$ar2str = null;
			for($in=0; $in<count($array); $in++)
			{
				$ar2str .= $array[$in].$elementSeparator;
			}
			$str = $ar2str.$elementSeparator;
			return str_replace($elementSeparator.$elementSeparator, '', $str);
		}

		/**
		 * Gets the current system time (12 hours format).
		 * @return string
		 */
		public static function getSystemTime12()
		{
			$hx = (date('h')+5)*3600;
			$mx = (date('i')+30)*60;
			$sx = date('s');
			$tSec = $hx + $mx + $sx;
			$h = (int)($tSec/3600);
			$m = (int)(($tSec-($h*3600))/60);
			$s = $tSec-(($h*3600)+($m*60));
			if($h>12)
			{
				$h = $h-12;
			}
			else if($h<1)
			{
				$h = $h+12;
			}
			
			if((int)($tSec/3600)>11)
			{
				$sft = 'PM';
			}
			else
			{
				$sft = 'AM';
			}
			return (Core::addZero($h).':'.Core::addZero($m).':'.Core::addZero($s).' '.$sft);
		}

		/**
		 * Gets the current system time (24 hours format).
		 * @return string
		 */
		public static function getSystemTime24()
		{
			$hx = (date('h')+5)*3600;
			$mx = (date('i')+30)*60;
			$sx = date('s');
			$tSec = $hx + $mx + $sx;
			$h = (int)($tSec/3600);
			$m = (int)(($tSec-($h*3600))/60);
			$s = $tSec-(($h*3600)+($m*60));
			return (Core::addZero($h).':'.Core::addZero($m).':'.Core::addZero($s));
		}

		public static function addZero($number)
		{
		    if($number < 10)
		    {
                	return ('0'.$number);
		    }
		    else
		    {
		        return ($number);
		    }
		}

		public static function redirectTo($url)
		{
			header('Location:'.$url);
		}

		public static function autoRefresh($seconds)
		{
			header('refresh:'.$seconds);
		}
	}
?>
