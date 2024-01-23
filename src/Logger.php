<?php

namespace Application;

final class Logger
{
    private const DEFAULT_STYLE = 'border: 1px solid #2f343f; padding: 10px; black: white; font-weight: bold;';

    private string $customStyle = '';

    public function debug(mixed $var, mixed $var2 = null): void
    {
        $argsCount = func_num_args();

        echo $this->applyStyle();

        if ($argsCount > 1) {
            $args = func_get_args();

            foreach ($args as $arg) {
                if (is_array($arg) || is_object($arg)) {
                    print_r($arg);
                } else {
                    echo $arg;
                }
            }
        }
        else {
            if (is_array($var) || is_object($var)) {
                print_r($var);
            } else {
                echo $var;
            }
        }

        echo '</xmp>';
    }

    public function log(): void
    {

    }

    public function setCustomStyle(string $customStyle): void
    {
        $this->customStyle = $customStyle;
    }

    private function applyStyle(): string
    {
        $tagPattern = '<xmp style="%s">';

        if ('' === $this->customStyle) {
            return sprintf($tagPattern, self::DEFAULT_STYLE);
        }

        return sprintf($tagPattern, $this->customStyle);
    }
}