<?php

$field = $args['field'] ?? '';
$class = $args['class'] ?? '';

$wysiwyg_editor = $field && is_array($field) ? $field : get_sub_field($field ?: 'wysiwyg_editor');
$wysiwyg_editor = $wysiwyg_editor['wysiwyg_editor'] ?? '';

if ($wysiwyg_editor) {
  echo '<div class="prose max-w-none lg:prose-lg">';
  echo $wysiwyg_editor;
  echo '</div>';
}
