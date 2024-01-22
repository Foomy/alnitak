<?php

namespace Application;

final class Logger
{
    public function debug(mixed $var, mixed $var2 = null): void
    {
        $argsCount = func_num_args();

        if ($argsCount > 1) {
            $args = func_get_args();

            foreach ($args as $arg) {
                if (is_array($arg) || is_object($arg)) {
                    echo '  <xmp>' . PHP_EOL;
                    print_r($arg);
                    echo '  </xmp>' . PHP_EOL;
                } else {
                    echo $arg;
                }
            }
        }
        else {
            if (is_array($var) || is_object($var)) {
                echo '  <xmp>' . PHP_EOL;
                print_r($var);
                echo '  </xmp>' . PHP_EOL;
            } else {
                echo $var;
            }
        }
    }

    public function log(): void
    {

    }
}