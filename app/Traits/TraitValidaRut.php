<?php
namespace App\Traits;

trait TraitValidaRut
{
	public static function comprueba($rut){
		$formateaRut = self::formatearRut($rut);
		if (!$formateaRut){
			return false;
		}
		list($numero, $digitoVerificador) = explode('-', $formateaRut);
		if((($digitoVerificador != 'K') && (!is_numeric($digitoVerificador))) || (count(str_split($numero)) > 11)){
			return false;
		}
		foreach(str_split($numero) as $chr) {
			if (!is_numeric($chr)){
				return false;
			}
		}
		$digit = self::digitoVerificador($numero);
		if($digit == $digitoVerificador){
			return true;
		}		
		return false;
	}
	public static function formatearRut($originalRut, $incluyeDigitoVerificador = true) {	
		$originalRut 	= trim($originalRut);
		$originalRut 	= ltrim($originalRut, '0');
		$arrSeparaRut 	= str_split($originalRut);
		$formateaRut	= '';
		foreach ($arrSeparaRut as $key => $chr) {
			if ((($key + 1) == count($arrSeparaRut)) && ($incluyeDigitoVerificador)){
				if (is_numeric($chr) || ($chr == 'k') || ($chr == 'K')){
					$formateaRut .= '-'.strtoupper($chr);
				}else{
					return false;
				}
			}elseif(is_numeric($chr)){
				$formateaRut .= $chr;
			}
		}
		if (strlen($formateaRut) < 1){ //Longitud
			return false;
		}		
		return $formateaRut;
	}
	public static function digitoVerificador($rut) {
		$numero 	= self::formatearRut($rut, false);
		$txt		= array_reverse(str_split($numero));
		$sum		= 0;
		$factores	= array(2,3,4,5,6,7,2,3,4,5,6,7);
		foreach($txt as $key => $chr) {
			$sum += $chr * $factores[$key];
		}
		$a = $sum % 11;
		$b = 11-$a;
		if($b == 11){
			$digitoVerificador	= 0;
		}elseif($b == 10){
			$digitoVerificador	= 'K';
		}else{
			$digitoVerificador = $b;
		}
		$digitoVerificador = (string)$digitoVerificador;
		return $digitoVerificador;
	}
}