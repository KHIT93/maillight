<?php
namespace MailLight\Support;

class ConfigHelper
{
    public static function getConfVar($key)
    {
        return \Cache::remember($key, 525600, function() use($key) {
            $output = [];
            $main_conf = ConfigHelper::parseConfigFile(config('mail.mailscanner.config_dir').'MailScanner.conf');
            $extra_conf = ConfigHelper::parseConfigDir(config('mail.mailscanner.config_dir').'conf.d');
            if(is_array($extra_conf))
            {
                $output = array_merge($main_conf, $extra_conf);
            }
            else
            {
                $output = $main_conf;
            }

            foreach ($output  as $param_key => $param_value)
            {
                $param_key = preg_replace('/ */', '', $param_key);
                if(strtolower($param_key) === strtolower($key))
                {
                    if(is_file($param_value))
                    {
                        return ConfigHelper::readRuleset($param_value);
                    }
                    else
                    {
                        return $param_value;
                    }
                }

            }
		});
    }

    public static function parseConfigFile($path)
    {
        return \Cache::remember($path, 525600, function() use ($path) {
            $output = [];
            $var = [];
            $fh = null;
            try
            {
                $fh = fopen($path, 'rb');
            }
            catch (\Exception $e)
            {
                die($e->getMessage());
            }
            while (!feof($fh))
            {
                //Read each line
                $line = rtrim(fgets($fh, 4096));

                //Find all lines that match
                if(preg_match("/^(?P<name>[^#].+[^\s*$])\s*=\s*(?P<value>[^#]*)/", $line, $regs))
                {
                    // Strip trailing comments
                    $regs['value'] = preg_replace("/#.*$/", '', $regs['value']);
                    // store %var% variables
                    if (preg_match('/%.+%/', $regs['name'])) {
                        $var[$regs['name']] = $regs['value'];
                    }
                    // expand %var% variables
                    if (preg_match('/(%[^%]+%)/', $regs['value'], $matches)) {
                        array_shift($matches);
                        foreach ($matches as $varname) {
                            $regs['value'] = str_replace($varname, $var[$varname], $regs['value']);
                        }
                    }
                    // Remove any html entities from the code
                    $key = htmlentities($regs['name']);
                    //$string = htmlentities($regs['value']);
                    $string = $regs['value'];
                    // Stuff all of the data to an array
                    $output[$key] = $string;
                }
            }
            fclose($fh);
            unset($fh);
            return $output;
        });
    }

    public static function parseConfigDir($dir)
    {
        return \Cache::remember($dir, 525600, function() use ($dir) {
            $array_output1 = array();
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    // remove the . and .. so that it doesn't throw an error when parsing files
                    if ($file !== '.' && $file !== '..') {
                        $file_name = $dir . $file;
                        if (!is_array($array_output1)) {
                            $array_output1 = ConfigHelper::parseConfigFile(config($file_name));
                        } else {
                            $array_output2 = ConfigHelper::parseConfigFile(config($file_name));
                            $array_output1 = array_merge($array_output1, $array_output2);
                        }
                    }
                }
            }
            closedir($dh);
            return $array_output1;
		});
    }

    public static function readRuleset($path)
    {
        $fh = null;
        try
        {
            $fh = fopen($path, 'rb');
        }
        catch (\Exception $e)
        {

        }
        while (!feof($fh))
        {
            $line = rtrim(fgets($fh, filesize($file)));
            if (preg_match('/(\S+)\s+(\S+)\s+(\S+)/', $line, $regs)) {
                if (strtolower($regs[2]) === 'default') {
                    // Check that it isn't another ruleset
                    if (is_file($regs[3])) {
                        return read_ruleset_default($regs[3]);
                    } else {
                        return $regs[3];
                    }
                }
            }
        }
    }
}
