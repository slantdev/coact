<?php

$field = $args['field'] ?? '';
$class = $args['class'] ?? '';

$code_editor = $field && is_array($field) ? $field : get_sub_field($field ?: 'code_editor');
$code_editor = $code_editor['code_editor'] ?? '';

if ($code_editor) {
  echo '<div>';
  echo $code_editor;
  echo '</div>';
}
