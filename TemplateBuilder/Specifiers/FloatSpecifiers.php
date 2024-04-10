<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

use Exception;
use FpDbTest\TemplateBuilder\Utils;


/**
 * Class for replace signature ?f to template.
 */
class FloatSpecifiers  extends DefaultSpecifiers
{
    // signature of template, this signature is searcher for replace
    static string $signature = "?f";

    #[\Override] public static function renderTemplate(&$template, $args): void
    {
        if (is_float($args)){
            $template = Utils::strReplaceFirst(self::$signature, $args, $template);
            return;
        }
        if (is_null($args)){
            $template = Utils::strReplaceFirst(self::$signature, "NULL", $template);
            return;
        }
        throw new Exception("Wrong type to template");
    }
}