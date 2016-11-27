<?php
  /**
   * i18n wrappers
   * @param string $message
   * @param mixed $params (string, array, varargs)
   * @param string $context
   * @return string Translated phrase
   */
  function ___()
  {
    $args = func_get_args();
    $message = $args[0];
    $count = substr_count($message, '%s');
    if (!$count) {
      $params = array();
      $context = isset($args[1]) ? $args[1] : 'app';
    } else {
      if (is_array($args[1])) {
        $params = $args[1];
        $context = isset($args[2]) ? $args[2] : 'app';
      } else {
        $params = array();
        for ($i=1; $i <= $count; $i++) {
          $params[] = $args[$i];
        }
        $context = isset($args[$i]) ? $args[$i] : 'app';
      }
    }

    return call_user_func_array("sprintf", array_merge(array(Yii::app()->i18n->t($context, $message, array())), $params));
  }


  function __()
  {
    echo call_user_func_array('___',func_get_args());
  }

  /**
   * i18n wrappers for date
   * @return date
   */
  function __d($value, $format='d/m/Y'){
    if(!is_int($value)){
      $value = strtotime($value);
    }
    return date($format, $value);
  }
  function _d($value){
    echo __d($value);
  }

  function d__($value){
    if(!is_int($value)){
      $value = strtotime($value);
    }
    return date('Y-m-d', $value);
  }
  function d_($value){
    echo d__($value);
  }

  /**
   * i18n wrappers for time
   * @return date
   */
  function __t($value){
    return date('h:i:s A', $value);
  }
  function _t($value){
    echo __t($value);
  }

  /**
   * i18n wrapper for datetime
   * @return date
   */
  function __dt($value){
    return date('d/m/Y h:i:s A', $value);
  }
  function _dt($value){
    echo __dt($value);
  }

  /**
   * i18n wrapper for number
   * @return string
   */
  function __n($value){
    return number_format($value,null,',','.');
  }
  function _n($value){
    echo __n($value);
  }

  /**
   * i18n wrapper for money
   * @return string
   */
  function __m($value, $suffix = 'VND'){
    return number_format($value,null,',','.').$suffix;
  }
  function _m($value, $suffix = 'VND'){
    echo __m($value);
  }


  /**
   * i18n wrapper for percentage
   * @return string
   */
  function __p($value, $limit = false){
    return ($value>1&&$limit)?'100%':round($value*100).'%';
  }
  function _p($value, $limit = false){
    echo __p($value, $limit);
  }

  /**
   * i18n wrapper for date diff
   * @return date
   */
  function __dd($day1, $day2 =null, $format = null){
    if ($day2) {
      $intervalo = date_diff(date_create($day2), date_create($day1));
    } else {
      $intervalo = date_diff(date_create(), date_create($day1));
    }
    if ($format !== null) {
      return $intervalo->format($format);
    }

    return $intervalo->days;
  }
  function _dd($day1, $day2 =null, $format = null){
    echo __dd($day1, $day2, $format);
  }

  function m__($value, $suffix = '&#273;'){
    return intval(str_replace(array(',', '.', $suffix, ' '), '', $value));
  }
  function m_($value, $suffix = '&#273;'){
    echo m__($value);
  }
?>