<?php
    namespace Cherry\Utils;

    use Cherry\Core;
    Core::importSingleFile(dirname(dirname(__FILE__)).'/FileSystem/FileManager.php');

    /**
	 * <b>FILE : </b>Thumbnail.php<br>
     * <b>COPYRIGHT : </b>©2020 | AuroraSoftwares<br>
     * <b>VERSION : </b>1.0
	 */
    class Thumbnail
    {
        /**
         * Creates an image thumbnail. Supported image formats are - '.jpg', '.jpeg', '.png' and '.gif' only;
         * @return bool
         */
        public static function createThumbnail($sourcePath, $destinationPath, $width, $height=null)
        {
            $source_image = null;
            $fm = new \FileManager($sourcePath);
            $ext = strtolower($fm->getFileExtension());

            if($ext === 'jpg' || $ext === 'jpeg')
            {
                $source_image = imagecreatefromjpeg($sourcePath);
            }
            else if($ext === 'png')
            {
                $source_image = imagecreatefrompng($sourcePath);
            }
            else if($ext === 'gif')
            {
                $source_image = imagecreatefromgif($sourcePath);
            }
            else
            {
                $source_image = null;
            }

            $w = imagesx($source_image);
            $h = imagesy($source_image);

            if($height === null)
            {
                $height = floor($h * ($width / $w));
            }

            $thumb_image = imagecreatetruecolor($width, $height);
            imagecopyresampled($thumb_image, $source_image, 0, 0, 0, 0, $width, $height, $w, $h);

            if($ext === 'jpg' || $ext === 'jpeg')
            {
                return(imagejpeg($thumb_image, $destinationPath));
            }
            else if($ext === 'png')
            {
                return(imagepng($thumb_image, $destinationPath));
            }
            else if($ext === 'gif')
            {
                return(imagegif($thumb_image, $destinationPath));
            }
        }
    }
?>