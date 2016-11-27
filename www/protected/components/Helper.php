<?php
/**
 * Helper
 */
class Helper extends CComponent {


  /**
   * Nicer Price 
   *
   * @param string $price 
   * @param string $prefix
   * @author Long Nguyen
   */
  public static function nicePrice($price = 0, $suffix = '₫'){
    $nicePrice = number_format($price, 0, ',', '.');
    return $nicePrice.$suffix;
  }

  /**
   * Convert non-US time string into UNIX timestamp
   * @static
   * @param $time string time in dd/mm/yyyy format
   * @return bool|int false on failure, UNIX timestamp on success.
   * @author Long Doan
   */
  public static function ddmmyyToTimestamp($time) {
    $dateTokens = explode('/', $time);
    if (count($dateTokens) == 3) {
      return strtotime($dateTokens[1] . '/' . $dateTokens[0] . '/' . $dateTokens[2]);
    }
    return false;
  }

}
?>