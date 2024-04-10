<?php

namespace FpDbTest\TemplateBuilder;

class Utils
{
    public static function strReplaceFirst($search, $replace, &$subject): string
    {
        $search = '/'.preg_quote($search, '/').'/';
        return preg_replace($search, $replace, $subject, 1);
    }
}