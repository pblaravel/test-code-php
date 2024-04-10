<?php

namespace FpDbTest\TemplateBuilder\Specifiers;

use Exception;
use FpDbTest\TemplateBuilder\Utils;


/**
 * Class default for replace signature ?a to template.
 */
class ArraySpecifiers  extends DefaultSpecifiers
{
    // signature of template, this signature is searcher for replace
    static string $signature = "?a";

    /**
     * Function render template and replace signature by value.
     * if associative array ['name' => 'Jack', 'email' => null] replace to `name` = \'Jack\', `email` = NULL
     * if is list of value [1, 2, 3] replace to 1, 2, 3
     *
     * @throws Exception
     */
    #[\Override] public static function renderTemplate(&$template, $args): void
    {
        if (!array_is_list($args)){
            $template = Utils::strReplaceFirst(self::$signature, self::formatArray($args), $template);
            return;
        }
        if (array_is_list($args)){
            $template = Utils::strReplaceFirst(self::$signature, implode(", ", $args), $template);
            return;
        }
        throw new Exception("Wrong type to template");
    }

    private static function formatArray(array $arr): string
    {
        $formatArray = [];
        foreach ($arr as $k => $s) {
            if (is_null($s)){
                $formatArray[] = sprintf("`%s` = NULL", $k);
            } else {
                $formatArray[] = sprintf("`%s` = '%s'", addslashes($k), addslashes($s));
            }

        }
        return implode(", ", $formatArray);
    }
}