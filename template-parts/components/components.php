<?php

$field = $args['field'] ?? 'components';

//preint_r($field);

if (!empty($field)) {
  foreach ($field as $layout) {
    $acf_fc_layout = $layout['acf_fc_layout'];
    if ($acf_fc_layout) {
      $template = 'template-parts/components/' . $acf_fc_layout;
      echo '<div class="component-wrapper">';
      get_template_part($template, '', array('field' => $layout));
      echo '</div>';
    }
  }
}
