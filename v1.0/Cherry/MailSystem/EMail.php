<?php
    namespace Cherry\MailSystem;
    /**
	 * <b>FILE : </b>EMail.php<br>
     * <b>COPYRIGHT : </b>©2020 | AuroraSoftwares<br>
     * <b>VERSION : </b>1.0
	 */
    
    class EMail
    {
        /**
         * Sends E-Mail to a specified mail-id.
         * @return bool
         */
        public static function sendEmail($sendTo, $subject, $message, $header)
        {
            return mail($sendTo, $subject, $message, $header);
        }
    }
?>