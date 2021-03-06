<?php
  
class form
{
  public static function construct($obj, $value = '')
  {
    $data = '';
    switch ($obj['type']) {
      case 'key':
        $data = self::getHidden($obj, $value);
        break;
      case 'hidden':
        $data = self::getHidden($obj, $value);
        break;
      case 'string':
        $data = self::getString($obj, $value);
        break;
      case 'password':
        $data = self::getPassword($obj, $value);
        break;
      case 'integer':
        $data = self::getInteger($obj, $value);
        break;
      case 'double':
        $data = self::getDouble($obj, $value);
        break;
      case 'text':
        $data = self::getText($obj, $value);
        break;
      case 'date':
        $data = self::getDate($obj, $value);
        break;
      case 'boolean':
        $data = self::getBoolean($obj, $value);
        break;
      default:
        break;
    }
    return $data;
  }
  
  public static function getHidden($obj, $value = '')
  {
    $data = '<input type="hidden" id="'.$obj['id'].'" name="'.$obj['id'].'" value="'.$value.'"/>';
    return $data;
  }
  
  public static function getString($obj, $value = '')
  {
    $data = '<div class="form-group">';
    if (isset($obj['name']) && $obj['name'] != '') {
      $data .= '<label for="'.$obj['id'].'">'.$obj['name'].'</label>';
    }
    $data .= '<input type="text" class="form-control" id="'.$obj['id'].'" name="'.$obj['id'].'" value="'.$value.'"';
    if (isset($obj['validator']) && $obj['validator'] != '') {
      $data .= ' data-fv '.$obj['validator'];
    }
    if (isset($obj['readonly']) && $obj['readonly'] == true) {
      $data .= ' disabled';
    }
    if (isset($obj['index'])) {
      $data .= ' tabindex="'.$obj['index'].'"';
    }
    if (isset($obj['maxlength']) && is_int($obj['maxlength'])) {
      $data .= ' maxlength="'.$obj['maxlength'].'"';
    }
    $data .= '/>';
    $data .= '</div>';
    return $data;
  }
  
  public static function getPassword($obj, $value = '')
  {
    $data = '<div class="form-group">';
    if (isset($obj['name']) && $obj['name'] != '') {
      $data .= '<label for="'.$obj['id'].'">'.$obj['name'].'</label>';
    }
    $data .= '<input type="password" class="form-control" id="'.$obj['id'].'" name="'.$obj['id'].'" value="'.$value.'"';
    if (isset($obj['validator']) && $obj['validator'] != '') {
      $data .= ' data-fv '.$obj['validator'];
    }
    if (isset($obj['readonly']) && $obj['readonly'] == true) {
      $data .= ' disabled';
    }
    if (isset($obj['index'])) {
      $data .= ' tabindex="'.$obj['index'].'"';
    }
    if (isset($obj['maxlength']) && is_int($obj['maxlength'])) {
      $data .= ' maxlength="'.$obj['maxlength'].'"';
    }
    $data .= '/>';
    $data .= '</div>';
    return $data;
  }
  
  public static function getInteger($obj, $value = '')
  {
    $data = '<div class="form-group">';
    if (isset($obj['name']) && $obj['name'] != '') {
      $data .= '<label for="'.$obj['id'].'">'.$obj['name'].'</label>';
    }
    $data .= '<input type="text" class="form-control" id="'.$obj['id'].'" name="'.$obj['id'].'" value="'.$value.'"';
    if (isset($obj['validator']) && $obj['validator'] != '') {
      $data .= ' data-fv '.$obj['validator'];
    }
    if (isset($obj['readonly']) && $obj['readonly'] == true) {
      $data .= ' disabled';
    }
    if (isset($obj['index'])) {
      $data .= ' tabindex="'.$obj['index'].'"';
    }
    if (isset($obj['maxlength']) && is_int($obj['maxlength'])) {
      $data .= ' maxlength="'.$obj['maxlength'].'"';
    }
    $data .= '/>';
    $data .= '</div>';
    return $data;
  }
  
  public static function getDouble($obj, $value = '')
  {
    $data = '<div class="form-group">';
    if (isset($obj['name']) && $obj['name'] != '') {
      $data .= '<label for="'.$obj['id'].'">'.$obj['name'].'</label>';
    }
    $data .= '<input type="text" class="form-control" id="'.$obj['id'].'" name="'.$obj['id'].'" value="'.$value.'"';
    if (isset($obj['validator']) && $obj['validator'] != '') {
      $data .= ' data-fv '.$obj['validator'];
    }
    if (isset($obj['readonly']) && $obj['readonly'] == true) {
      $data .= ' disabled';
    }
    if (isset($obj['index'])) {
      $data .= ' tabindex="'.$obj['index'].'"';
    }
    if (isset($obj['maxlength']) && is_int($obj['maxlength'])) {
      $data .= ' maxlength="'.$obj['maxlength'].'"';
    }
    $data .= '/>';
    $data .= '</div>';
    return $data;
  }
  
  public static function getText($obj, $value = '')
  {
    $data = '<div class="form-group">';
    if (isset($obj['name']) && $obj['name'] != '') {
      $data .= '<label for="'.$obj['id'].'">'.$obj['name'].'</label>';
    }
    $data .= '<textarea class="form-control" id="'.$obj['id'].'" name="'.$obj['id'].'" rows="'.$obj['rowcount'].'"';
    if (isset($obj['readonly']) && $obj['readonly'] == true) {
      $data .= ' disabled';
    }
    if (isset($obj['index'])) {
      $data .= ' tabindex="'.$obj['index'].'"';
    }
    $data .= '>';
    $data .= $value;
    $data .= '</textarea>';
    $data .= '</div>';
    return $data;
  }
  
  public static function getDate($obj, $value = '')
  {
    $parsed = '';
    if ($value != '') {
      $date = date_parse_from_format('YmdTHiS', $value);
      if ($date['year'] > 0) {
        $parsed = $date['year'];
        if ($date['month'] > 0) {
          $parsed = $parsed.'/'.sprintf("%02d", $date['month']);
        }
        if ($date['day'] > 0) {
          $parsed = $parsed.'/'.sprintf("%02d", $date['day']);
        }
        if ($date['hour'] > 0) {
          $parsed = $parsed.' '.sprintf("%02d", $date['hour']);
        }
        if ($date['minute'] > 0) {
          $parsed = $parsed.':'.sprintf("%02d", $date['minute']);
        }
        if ($date['second'] > 0) {
          $parsed = $parsed.':'.sprintf("%02d", $date['second']);
        }
        if (strlen($parsed) == 4) {
          $parsed = $parsed.'/01/01';
        }
      } else {
        $parsed = '';
      }
    }
    $data = '<div class="form-group">';
    if (isset($obj['name']) && $obj['name'] != '') {
      $data .= '<label for="'.$obj['id'].'">'.$obj['name'].'</label>';
    }
    $data .= '<div class="input-group">';
    $data .= '<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>';
    $data .= '<input type="text" class="form-control" data-provider="datepicker" id="'.$obj['id'].'" name="'.$obj['id'].'" value="'.$parsed.'"';
    if (isset($obj['validator']) && $obj['validator'] != '') {
      $data .= ' data-fv '.$obj['validator'];
    }
    if (isset($obj['readonly']) && $obj['readonly'] == true) {
      $data .= ' disabled';
    }
    if (isset($obj['index'])) {
      $data .= ' tabindex="'.$obj['index'].'"';
    }
    if (isset($obj['maxlength']) && is_int($obj['maxlength'])) {
      $data .= ' maxlength="'.$obj['maxlength'].'"';
    }
    $data .= '/>';
    $data .= '</div>';
    $data .= '</div>';
    return $data;
  }
  
  public static function getBoolean($obj, $value = '')
  {
    $data = '<div class="form-group">';
    if (isset($obj['name']) && $obj['name'] != '') {
      $data .= '<label for="'.$obj['id'].'">'.$obj['name'].'</label>';
    }
    $data .= '<select type="text" class="form-control" id="'.$obj['id'].'" name="'.$obj['id'].'"';
    if (isset($obj['readonly']) && $obj['readonly'] == true) {
      $data .= ' disabled';
    }
    if (isset($obj['index'])) {
      $data .= ' tabindex="'.$obj['index'].'"';
    }
    $data .= '>"';
    $data .= '<option value=""></option>';
    $data .= '<option';
    if ($value == 'true') {
      $data .= ' selected';
    }
    $data .= ' value="true">True</option>';
    $data .= '<option';
    if ($value == 'false') {
      $data .= ' selected';
    }
    $data .= ' value="false">False</option>';
    $data .= '</select>';
    $data .= '</div>';
    return $data;
  }
}
  
?>