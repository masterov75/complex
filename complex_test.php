<?php

require_once('class_complex.php');

ob_start();
$a = new complex(5, 6);
$b = new complex(-3,4);
echo "a            = ".$a->asString()."\n";
echo "b            = ".$b->asString()."\n";
echo "Re(a)        = ".$a->re()."\n";
echo "Im(a)        = ".$a->im()."\n";
echo "b + a        = ".$b->plus($a)->asString()."\n";
echo "a - b        = ".$a->minus($b)->asString()."\n";
echo "a * b        = ".$a->mul($b)->asString()."\n";
echo "b * a        = ".$b->mul($a)->asString()."\n";
echo "a / b        = ".$a->div($b)->asString()."\n";
echo "(a / b) * b  = ".$a->div($b)->mul($b)->asString()."\n";
echo "a - (5+6i)   = ".$a->minus(5,6)->asString()."\n";
$result = ob_get_contents();
ob_end_flush();

$correct = <<<EOT
a            = 5 + 6i
b            = -3 + 4i
Re(a)        = 5
Im(a)        = 6
b + a        = 2 + 10i
a - b        = 8 + 2i
a * b        = -39 + 2i
b * a        = -39 + 2i
a / b        = 0.36 - 1.52i
(a / b) * b  = 5 + 6i
a - (5+6i)   = 0 + 0i

EOT;

if ($result===$correct) {
	echo "Тестирование завершено. Класс работает корректно\n";
} else {
	echo "ОШИБКА! Класс работает некорректно\n";
}

?>