<?php
	namespace Cherry;
	/**
	 * <b>FILE : </b>Core.php<br>
     * <b>COPYRIGHT : </b>©2020 | AuroraSoftwares<br>
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

		/**
		 * Returns '32 X 32' Base64 PNG data of Cherry Logo.
		 */
		public static function CherryLogo32()
		{
		    return('data:image:png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABmJ
            LR0QAAAAAAAD5Q7t/AAAACXBIWXMAAC4jAAAuIwF4pT92AAAJ4E
            lEQVRYR8WWeTzV6R7Hv9Rte3XTpBJZEjp2KhkSRdZEZYZEphFqa
            NM03ZZpZtqkjaaFIRVRCg0pKTW2OJYOIUvRDaUYdaJI4Ti/7/3+
            fkfdmdfE9Lr/3D/eftvzPJ/P810eBxAR/p9At7gbEtojIfh54Kf
            TGghBDYGwszAQfvyNYxihStgSXxGBQTlbfSKKQ2wj74SqEyMI4B
            CEwulHoZDdeRXEjBjgjbgTVj11AK06AM1a4gEArxJAoxhALZOuh
            fTuvuTb+zHst8nhAPIHYJj8fjAjoolHxFuij2AIcf9zI5FIfEGM
            I0DhKMAagSuIxKL/GmBF1PkAyucliyuEcgLcVSUBYFq5RJxXIxl
            DC40mgojWfkHkOAw4OQxQKRpQ5SLglBTiEjDK56BL6TTkTv4FNp
            KBmavSXEd9MODX4AAql/pF938cpbMSE2rZ9HyI2/lP/TtEekbFk
            xIx2gTyKgBpQ0iGGUJEvKTIVtK7KxTdA9Pugsv6h66yEgN9neBd
            6sAu+kfBoQSPWER4ECbEKNoVTI7gvlsQz1lxxQhAShXyqjhBpDQ
            xRK/hwxF1NvWq0bYNU70JI0KOGE5IEbCndS2IGNaAqBOWX3X4o/
            hEYi/RQHQTIkJInCVU+sfsJsQUTtQQ/En4DZFJ+Ls/Npla31M7t
            Ln3CXyMtr4XwDAMGejpBM/EDwbGE+eIXi60B/uR5Jctrhg2EsRB
            ihhD6Xgv3keUE17EWLZYVzTNg7firr9vwz8YkCZ2UOH1KEYCql6
            lfOYSOXSfTkV1ljPDRsKcCKCci9iwk1gPEUOoE1Ks+P9qQFvhGD
            xSTesvoloupGKCLSKGVw2Myq/UWgfgAI21Uo6HDiqsXvp+UqsWx
            s0uHgq+iXKw66IRBFd4wvXXCVyOP9WANInvVs/jxFpp0ZtEKN0H
            0OKeRKBO3ZBoMtaoGAXlZMCMDNSTgVzDe9IKG1O1oCQxCLpy80H
            89Hdgenq4/P6d+AcDy1Md9NSyIJ0E95KYkUGl1Gin66Nge5QqnI
            pbAGert0LKq+h/BDxx1NfPHh5O7WqtFAsx5kUjnWNjXYa05eaM6
            W5+Pr5H2C4j7ukd8qninIF3ondw8vGBad8981DZ3OIhvaXRHeKP
            LYbq+U7DmzftN3h66Ixv/b6IvfUHovY+iIjyOf+zx2z/CLNJq2P
            M9BK2LXSu8d124u7iNbdL7H3LSp398+8H7ot8Fpfq2Ma/O1rcK+
            Ii8Z6PGmA/vOppg6SyMKhOugB1u49JCay/1i7Qd44qNFzcXDTDp
            U9g7MaUmLozpWYeortzPJ+VOficKbVbef6OsWs7jWH4egsxX2sB
            5mk6YB7PniE6is0942u3hWjW/XAUHhIvs4o+boD981rYAilebpC
            tbSdFi1jwdRaWFxkuEQtMlmKZ5Qqssl+FNU4B+GDxOnywaC3ed/
            Rnquz8mHuWX+NdMw+8Y/QlFhg4Y772AtYA5mnY4m11W3GOuk0ho
            ZurYQuNx+IGNtDd8hwENt5Ak3X5Oo4VJM6UzF6G9+z8sNZ1Izas
            /AGb1uzFp+v2YVPAHnzs8yPWe2zBOpcNWO2wGsvnfoUUDSzQc5I
            YULPBXNX5mDXFUpyhPPdKuoqFbN2R6L81MCJPa0FMgf4iseDzpX
            jPxgfr3L/DJ+uDsXXXLyg8FI0vD8egcN8pbP3+ODZv2I9PyNi/3
            TZhDZkom+OJxdOXIJ9Nw1RrzFW2xExFC7ymYNadLG8SUBNySmpQ
            AyW2K834ugtfFM/8AsvmemGNy3pspF23Bp/C9tPJ2JGQgR1JN/F
            1XBq2h13EF3siseXbg/jYewcXiUorbyyhVBRSLeTT7nOV5mGWgj
            lem2TKJE2cxa88HCU7mAGpEjufICo8ye4p9A9XbMdnO47hy5NJ2
            JGSiV23CrEr6w6+ucHHjsQMbCMTrT+cwCb/Pfho6XdYQ3NKqWaK
            tKkgVa3xtiIZkDfH63KmmDjBqL3iYKTpYAZGkoGMAoNFyOa+igq
            ufvVObA6KxLaYy9hxNQe7MouxK0eAb8hIR3ImtkUmYevOcKqNIK
            xfthlrFqzGuzS3WNcJ+VQDeZQCNgLpZODC+JmisoMRXoMYeCHL9
            vEHAwv98ZHvj/jspzAUhl/EV/HpXBQ6U7Ox49ItbI++jEKqh5Yt
            R/CJ3058RHVQ7bBKYkDPGfnq1AUqVvgb1UCqnAmeHWcoFuwPXz9
            YBCYI7Hwq+VTFAqrmCuuVWOu+CR9T1beQiRck9vJ4PLaduIDCI3
            H4fO9J/J3E2fDXL9+CtYvWYSXNKaX0FbERULfD3ClWeGOyOSZNm
            IVRY/XERcFhawc20Cr85x173/w86uNCquRS2kkl5bSOdtZAkWja
            EIzNm0Ow5V+h2LLpED5bF4xNtPP65VslrUhjy82Xo2DGF1wRsm2
            YqTwPr8jPxjjZ6Rgmo9NT8vPpLwc00CNsG1K4wO90Fs+Wua3jyJ
            lgU1FJrXjfeQ3Xag1eW7Hx6++xcQXhtQ3rqUXrlmzgWrCCzoESY
            zfJ7jXsMEfVCq+zu584C0+N1cejMtotVbGX9AaOgLAdbtt7e11T
            tey+NY0OEYpEgeFiZDuCbclKW1+scfTHB2SGDXetM3caYhW9Z8X
            Z0BcbLEY+z4HE52OGkgUmT/qczT2eGKPNHBmrnVod9+uoAQ28E7
            bBLWuvyUmKs0svq1gwGerzMVvLHvP1nbBopgsZceOO3HILL06QP
            fnKKOSlpu54Zxb1PhUvm75sNWu8QeIpk0wwlkIfLqOLIaM1Xx8f
            p7ek5lzyX8T/ZCDdylPqnLyxR5y8cXuSkhmTpjoPb2rYkBE62XQ
            XIp9E2NQUznDhrmyEWINsyrI07TFDbT5eVbbARHkTjB7P5R0Pj+
            b1HpHRDo+SmzHqwfmUwQ2kWS6jH4PGw2PkjLafmjCjI3bSLCZRc
            TamTrHAdDUrzsxvPFvM5NnR1Q5vTbPFDA1rvEbfLk+Zi+xYmoOR
            sgZ4dKw2c2iMZnfYeIPYswrGcrGKJvDwQurABqgIocjRDzLVbeD
            mVKuRUROmr6aw1f0y3qDvzMSZSMYwQdEULynNwWRlc0xWMcdLyn
            M40XiFzzFmkhGenDAdaQ6GyGiJSbw+xsRpc+OvNz77PT0HWtNz4
            W1T88AGel+2Q6nTN+x/Q8jWsAESlT4xTo9HbKNFc8PG6QsjyAwZ
            Y1hDZ+Rm4umJM0jUEMNl9Zljn+myhfYmVEb7HrHv6Gc6OslO3tK
            9XW8/KvoXA6KOTni48zhU+e2ACt/tcNNjPaQtDYD0pWuk0t3Xyq
            S7rzGiZ5+rbv4hV9z8E4i0VOKy6zfJKa7fRBDf0rv5NF6exknTP
            RTsOgKid92fZoD9VSTu7oE+msAievtuMIYSI/oZRkh9bFxf96f9
            MP0PBXvgoxLUbmoAAAAASUVORK5CYII=');
		}
		/**
		 * Returns '64 X 64' Base64 PNG data of Cherry Logo.
		 */
		public static function CherryLogo64()
		{
		    return('data:image/png;base64,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
            +N/AMZNIlYhWpB5AAAAAElFTkSuQmCC
            ');
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
