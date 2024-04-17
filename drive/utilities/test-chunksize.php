<?php

        /**
        * Return ini values in bytes
        *
        * @param string $val value to convert
        *
        * @return value in bytes
        */
        function returnIniBytes($val)
        {
            $val = trim($val);
            $last = strtolower($val[strlen($val)-1]);

            $val = floatval($val);

            switch($last) 
            {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
            }
            return $val;
        }

        /**
        * Server available max upload size
        *
        * @return available max upload size in bytes
        */
        function getMaxUploadSizeOLD()
        {
            // select maximum upload size
            $max_upload = (returnIniBytes(ini_get('upload_max_filesize'))/2);
            // select post limit
            $max_post = (returnIniBytes(ini_get('post_max_size'))/2);
            // select memory limit
            $init_memory_limit = ini_get('memory_limit');
            // set equal to post_max_size if memory_limit is unlimited
            $memory_limit = $init_memory_limit == '-1' ? $max_post : (returnIniBytes($init_memory_limit)/2);
            // get the smallest of them, this defines the real limit
            $available = min($max_upload, $max_post, $memory_limit);

            // return the value in bytes
            return round($available);
        }

        /**
        * Server available max upload size
        *
        * @return available max upload size in bytes
        */
        function getMaxUploadSize()
        {
            // select maximum upload size
            $max_upload = (returnIniBytes(ini_get('upload_max_filesize'))/2);
            // select post limit
            $max_post = (returnIniBytes(ini_get('post_max_size'))/2);
            // select memory limit
            $init_memory_limit = ini_get('memory_limit');
            // set equal to post_max_size if memory_limit is unlimited
            $memory_limit = $init_memory_limit == '-1' ? $max_post : (returnIniBytes($init_memory_limit)/2);
            // get the smallest of them, this defines the real limit
            $available = min($max_upload, $max_post, $memory_limit);
            $available_safe = max(1048576, $available);

            // return the value in bytes
            return round($available_safe);
        }


        function getChunkSizeOLD()
        {
            $serverSize = getMaxUploadSizeOLD();
            $idealSize = 32*1048576; // 1048576 == 1MB
            return min($serverSize, $idealSize);
        }

        function getChunkSize()
        {
            $serverSize = getMaxUploadSize();
            $idealSize = 32*1048576; // 1048576 == 1MB
            return min($serverSize, $idealSize);
        }


$chunk_size_old = getChunkSizeOLD();
$chunk_size_new = getChunkSize();

        echo "CHUNK SIZE OLD:<br>" . $chunk_size_old .'<br><br>';
        echo "CHUNK SIZE FIX:<br>" . $chunk_size_new .'<br>';

  ?>