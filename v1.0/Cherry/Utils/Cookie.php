<?php
    namespace Cherry\Utils;
	/**
	 * <b>FILE : </b>Cookie.php<br>
     	 * <b>COPYRIGHT : </b>©2021 | Aurora Softwares<br>
     	 * <b>VERSION : </b>1.0
	 */
	class Cookie
	{
		/**
		 * Sets cookie.
		 * @return bool
		 */
		public static function set($cookieName, $cookieValue, $ifDurationSeconds, $ifAccessiblePath)
		{
			$dur = null;
			if($ifDurationSeconds === null)
			{
				$dur = null;
			}
			else
			{
				$dur = time()+$ifDurationSeconds;
			}

			if($ifAccessiblePath === null)
			{
				$ifAccessiblePath = "";
			}
			return(setcookie($cookieName, $cookieValue, $dur, $ifAccessiblePath));
		}

		/**
		 * Checks whether the specified cookie is existed or not.
		 * @return bool
		 */
		public static function cookieExists($cookieName)
		{
		    if(isset($_COOKIE[$cookieName]))
		    {
		    	return(true);
		    }
		    else
		    {
		    	return(false);
		    }
		}

		/**
		 * Gets the value of specefied cookie.
		 * @return string
		 */
		public static function get($cookieName)
		{
		    return($_COOKIE[$cookieName]);
		}

		/**
		 * Deletes the specefied cookie.
		 * @return bool
		 */
		public static function deleteCookie($cookieName)
		{
			if(setcookie($cookieName, "", time()-3600, "/"))
			{
				return(true);
			}
			else
			{
				return(false);
			}
		}
	}
?>
