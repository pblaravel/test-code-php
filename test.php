<?php

use FpDbTest\Database;
use FpDbTest\DatabaseTest;
use FpDbTest\TemplateBuilder\Template;

spl_autoload_register(function ($class) {
    $a = array_slice(explode('\\', $class), 1);
    if (!$a) {
        throw new Exception();
    }
    $filename = implode('/', [__DIR__, ...$a]) . '.php';
    require_once $filename;
});

$mysqli = @new mysqli('localhost', 'root', 'rootpassword', 'test_code', 3306);
if ($mysqli->connect_errno) {
    throw new Exception($mysqli->connect_error);
}

$template = new Template();
$db = new Database($mysqli, $template);
$test = new DatabaseTest($db);
$test->testBuildQuery();
$test->testAdditionalBuildQuery();

exit('OK');
