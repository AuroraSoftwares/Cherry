<?php
	use Cherry\Core;
	/**
	 * <b>FILE : </b>Calendar.php<br>
	 * <b>COPYRIGHT : </b>©2020 | AuroraSoftwares<br>
     * <b>VERSION : </b>1.0
	 */

	class Calendar
	{
		private $d;
		private $m;
		private $y;

		/**
		 * Instantiates a new Calendar object.
		 * @param int $date
		 * @param int $month
		 * @param int $year
		 */
		function __construct($date=null, $month=null, $year=null)
		{
			if($date === null)
			{
				$this -> d = (date("d")+0);
			}
			else
			{
				$this -> d = ($date+0);
			}

			if($month === null)
			{
				$this -> m = (date("m")+0);
			}
			else
			{
				$this -> m = ($month+0);
			}

			if($year === null)
			{
				$this -> y = (date("Y")+0);
			}
			else
			{
				$this -> y = ($year+0);
			}
		}

		/**
		 * Returns the date.
		 * @return int
		 */
		function getDate()
		{
			return($this -> d);
		}

		/**
		 * Returns the month.
		 * @return int
		 */
		function getMonth()
		{
			return($this -> m);
		}

		/**
		 * Returns the year.
		 * @return int
		 */
		function getYear()
		{
			return($this -> y);
		}

		/**
		 * Returns the name of the month.
		 * @return string
		 */
		function getMonthName()
		{
			$monthNames = array
			(
				'January', 'February', 'March', 'April',
				'May', 'June', 'July', 'August',
				'September', 'October', 'November', 'December'
			);
			return($monthNames[($this -> m)-1]);
		}

		/**
		 * Returns the short-name of the month.
		 * @return string
		 */
		function getMonthNameShort()
		{
			$monthNamesShort = array
			(
				'Jan', 'Feb', 'Mar', 'Apr',
				'May', 'Jun', 'Jul', 'Aug',
				'Sep', 'Oct', 'Nov', 'Dec'
			);
			return($monthNamesShort[($this -> m)-1]);
		}

		/**
		 * Returns the day-name.
		 * @return string
		 */
		function getDayName($showFullDayName=false)
		{
			if($showFullDayName == false)
			{
				return(date('D', strtotime($this->m.'/'.$this->d.'/'.$this->y)));
			}
			else
			{
				return(date('l', strtotime($this->m.'/'.$this->d.'/'.$this->y)));
			}
		}

		/**
		 * Returns the short-format of the calendar.
		 * @param string $dateSeparator
		 * @return string
		 */
		function getCalendar($dateSeparator = null)
		{
			if($dateSeparator === null)
			{
				$dateSeparator = '-';
			}
			return(Core::addZero($this->d).$dateSeparator.Core::addZero($this->m).$dateSeparator.$this->y);
		}

		/**
		 * Returns the full-format of the calendar.
		 * @param bool $showFullMonthName
		 * @return string
		 */
		function getFullCalendar($showFullNames=false)
		{
			if($showFullNames== false)
			{
				return($this->getDayName($showFullNames).', '.$this->d.$this->getDateSuff($this->d).' '.$this->getMonthNameShort($this->m).', '.$this->y);
			}
			else
			{
				return($this->getDayName($showFullNames).', '.$this->d.$this->getDateSuff($this->d).' '.$this->getMonthName($this->m).', '.$this->y);
			}
		}

		// PRIVATE FUNCTIONS :
		private function getDateSuff($date)
		{
			if($date==1 || $date==21 || $date==31)
			{
				return('st');
			}
			else if($date==2 || $date==22)
			{
				return('nd');
			}
			else if($date==3 || $date==23)
			{
				return('rd');
			}
			else
			{
				return('th');
			}
		}
	}
?>