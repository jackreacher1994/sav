<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Log extends CI_Log
{
    function __construct() {
        parent::__construct();
    }

    protected $_levels = array('ERROR' => 1, 'DEBUG' => 2, 'INFO' => 3, 'ALL' => 4, 'VED' => 5);
    
    public function write_log($level, $msg)
    {
        if ($this->_enabled === FALSE)
        {
            return FALSE;
        }

        $level = strtoupper($level);

        if (( ! isset($this->_levels[$level]) OR ($this->_levels[$level] > $this->_threshold))
            && ! isset($this->_threshold_array[$this->_levels[$level]]))
        {
            return FALSE;
        }

        if ( $this->_levels[$level] == 2 | $this->_levels[$level] == 3 )
        {
            return FALSE;
        }

        $filepath = $this->_log_path.'log-'.date('d-m-Y').'.'.$this->_file_ext;
        $message = '';

        if ( ! file_exists($filepath))
        {
            $newfile = TRUE;
            // Only add protection to php files
            if ($this->_file_ext === 'php')
            {
                $message .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
            }
        }

        if ( ! $fp = @fopen($filepath, 'ab'))
        {
            return FALSE;
        }

        flock($fp, LOCK_EX);

        // Instantiating DateTime with microseconds appended to initial date is needed for proper support of this format
        if (strpos($this->_date_fmt, 'u') !== FALSE)
        {
            $microtime_full = microtime(TRUE);
            $microtime_short = sprintf("%06d", ($microtime_full - floor($microtime_full)) * 1000000);
            $date = new DateTime(date('H:i:s d-m-Y.'.$microtime_short, $microtime_full));
            $date = $date->format($this->_date_fmt);
        }
        else
        {
            $date = date($this->_date_fmt);
        }

        $message .= $this->_format_line($level, $date, $msg);

        for ($written = 0, $length = strlen($message); $written < $length; $written += $result)
        {
            if (($result = fwrite($fp, substr($message, $written))) === FALSE)
            {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        if (isset($newfile) && $newfile === TRUE)
        {
            chmod($filepath, $this->_file_permissions);
        }

        return is_int($result);
    }

}