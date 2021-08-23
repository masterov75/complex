<?php

/*
 *  a            = 5.0 + 6.0i
 *  b            = -3.0 + 4.0i
 *  Re(a)        = 5.0
 *  Im(a)        = 6.0
 *  b + a        = 2.0 + 10.0i
 *  a - b        = 8.0 + 2.0i
 *  a * b        = -39.0 + 2.0i
 *  b * a        = -39.0 + 2.0i
 *  a / b        = 0.36 - 1.52i
 *  (a / b) * b  = 5.0 + 6.0i
*/

//Комплексные числа (КЧ)
class complex {

	private $re;   // Реальная часть КЧ
	private $im;   // Мнимая часть КЧ
	const BadArg = "В аргументах должен быть либо объект-комплексное число, либо его части (реал,мнимая)";

	// Конструктор
	public function __construct(float $real, float $imag) {
		$this->re = $real;
		$this->im = $imag;
	}

	// Методы для возврата частей КЧ
	public function re() { return $this->re; }
	public function im() { return $this->im; }


	// Сложение текущего КЧ с указанным КЧ в параметре
	// Параметром может быть либо объект - КЧ, либо реальная и мнимая части КЧ
	public function plus($a, $b=null): complex {
		if (is_object($a) && get_class($a)=='complex' && $b==null) {
			$real = $this->re + $a->re;
			$imag = $this->im + $a->im;
			return new complex($real, $imag);
		} elseif ( in_array(gettype($a),['double','integer']) && in_array(gettype($b),['double','integer']) ) {
			$c = new complex($a, $b);
			return $this->plus($c);
		} else {
			throw new Exception(__METHOD__.': '.self::BadArg);
		}
	}

	// Вычитание из текущего КЧ, указанного КЧ в параметре
	// Параметром может быть либо объект - КЧ, либо реальная и мнимая части КЧ
	public function minus($a, $b=null): complex {
		if (is_object($a) && get_class($a)=='complex' && $b==null) {
			$real = $this->re - $a->re;
			$imag = $this->im - $a->im;
			return new complex($real, $imag);
		} elseif ( in_array(gettype($a),['double','integer']) && in_array(gettype($b),['double','integer']) ) {
			$c = new complex($a, $b);
			return $this->minus($c);
		} else {
			throw new Exception(__METHOD__.': '.self::BadArg);
		}
	}


	// Умножение текущего КЧ на указанное в параметре
	// Параметром может быть либо объект - КЧ, либо реальная и мнимая части КЧ
	public function mul($a, $b=null): complex {
		if (is_object($a) && get_class($a)=='complex' && $b==null) {
			$real = $this->re * $a->re - $this->im * $a->im;
			$imag = $this->re * $a->im + $this->im * $a->re;
			return new complex($real, $imag);
		} elseif ( in_array(gettype($a),['double','integer']) && in_array(gettype($b),['double','integer']) ) {
			$c = new complex($a, $b);
			return $this->mul($c);
		} else {
			throw new Exception(__METHOD__.': '.self::BadArg);
		}
	}

	// Деление текущего КЧ на указанное в параметре
	// Параметром может быть либо объект - КЧ, либо реальная и мнимая части КЧ
	public function div($a, $b=null): complex {
		if (is_object($a) && get_class($a)=='complex' && $b==null) {
			$scale = $a->re*$a->re + $a->im*$a->im;
        	$reciprocal = new Complex($a->re/$scale, -$a->im/$scale);
			return $this->mul( $reciprocal );
		} elseif ( in_array(gettype($a),['double','integer']) && in_array(gettype($b),['double','integer']) ) {
			$c = new complex($a, $b);
			return $this->div($c);
		} else {
			throw new Exception(__METHOD__.': '.self::BadArg);
		}		
	}

	// Вернуть строковое представление числа 
	public function asString() {
		return $this->re.($this->im<0?' - ':' + ').abs($this->im).'i';
	}

}

?>
