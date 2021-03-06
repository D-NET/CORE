<?php

class modal
{
  public static function start($title = 'Modal Title', $target = '', $method = 'GET', $data_target = 'modal-body')
  {
    echo '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    echo '<h4 class="modal-title" id="modallabel">'.$title.'</h4>';
    echo '</div>';
    echo '<div class="modal-body" id="modal-body">';
    echo '<form class="form" id="modal-data" name="modal-data" data-validate="modal" data-target="#'.$data_target.'" action="'.$target.'" method="'.strtoupper($method).'"><fieldset>';
  }
          
  public static function end($title = null, $color = 'primary', $target = 'modal-data')
  {
    echo '</fieldset></form>';
    echo '</div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" class="btn btn-default" data-dismiss="modal">'.rb::get('global.close').'</button>';
    if ($title != null) {
      echo '<button data-query="'.$target.'" data-validate="modal" class="btn btn-'.$color.'" type="submit">'.$title.'</button>';
    }
    echo '</div>';
  }
}

?>