<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

use Exception;
use FpDbTest\TemplateBuilder\Utils;

class IntSpecifiers extends DefaultSpecifiers
{
    // signature of template, this signature is searcher for replace
    static string $signature = "?d";

    #[\Override] public static function renderTemplate(&$template, $args): void
    {
        if (is_int($args)){
            $template = Utils::strReplaceFirst(self::$signature, $args, $template);
            return;
        }
        if (is_bool($args)){
            $template = Utils::strReplaceFirst(self::$signature, $args ? 1 : 0, $template);
            return;
        }
        if (is_null($args)){
            $template = Utils::strReplaceFirst(self::$signature, "NULL", $template);
            return;
        }
        throw new Exception("Wrong type to template");
    }
}