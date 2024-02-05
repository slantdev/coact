<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>

  <script data-cfasync="false">
    // Global variable to pass backend vars to javascript
    var websiteData = {};
    websiteData.urlWebsite = '<?php echo get_site_url(); ?>';
    websiteData.urlTheme = '<?php echo get_template_directory_uri(); ?>';
    websiteData.googleMapsApi = '<?php echo GOOGLE_MAPS_API; ?>';
    websiteData.userIP = '<?php echo (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];  ?>';
  </script>

</head>

<body <?php body_class('bg-white font-montserrat text-brand-black overflow-x-hidden'); ?>>

  <?php do_action('coact_site_before'); ?>

  <div id="page" class="min-h-screen flex flex-col">

    <?php do_action('coact_header'); ?>

    <?php get_template_part('template-parts/site', 'header'); ?>

    <div id="content" class="site-content flex-grow">

      <?php do_action('coact_content_start'); ?>

      <main>