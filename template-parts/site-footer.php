<?php

$site_footer = get_field('site_footer', 'option');
$footer_top = $site_footer['footer_top'];
$columns = $footer_top['columns'];
$column_count = '3';
if ($columns) {
  $column_count = count($columns);
}
$about = $site_footer['about'];
$address_heading = $about['address_heading'];
$address = $about['address'];
$phone = $about['phone'];
$email = $about['email'];
$logo = $about['logo'];
$popular_content = $site_footer['popular_content'];
$popular_heading = $popular_content['heading'];
$popular_links = $popular_content['links'];
$connect = $site_footer['connect'];
$connect_heading = $connect['heading'];
$connect_links = $connect['links'];
$quick_links = $site_footer['quick_links'];
$quick_links_heading = $quick_links['heading'];
$quick_links_links = $quick_links['links'];
$copyright_info = $site_footer['copyright_info'];
$copyright_site_name = $copyright_info['copyright_site_name'];
$copyright_links = $copyright_info['copyright_links'];

$subscribe = get_field('subscribe', 'option')['subscribe'];
$subscribe_heading = $subscribe['heading'];
$subscribe_desciption = $subscribe['description'];
$subscribe_form_shortcode = $subscribe['form_shortcode'];
$subscribe_image = $subscribe['image'];
$subscribe_colors = $subscribe['subscribe_colors'];
$subscribe_background_color = $subscribe_colors['background_color'];
$subscribe_text_color = $subscribe_colors['text_color'];
$subscribe_style = '';
if ($subscribe_background_color) {
  $subscribe_style .= 'background-color: ' . $subscribe_background_color . ';';
}
if ($subscribe_text_color) {
  $subscribe_style .= 'color: ' . $subscribe_text_color . ';';
}

$term_id = '';
if (is_archive()) {
  $term_id = get_queried_object()->term_id;
}
if ($term_id) {
  $the_id = 'term_' . $term_id;
} else {
  $the_id = get_the_ID();
}
//echo $the_id;
$disable_subscribe = get_field('disable_subscribe', $the_id);

?>

<?php if ($subscribe && !$disable_subscribe) : ?>
  <section class="bg-brand-purple" style="<?php echo $subscribe_style ?>">
    <div class="relative container max-w-screen-xxl mx-auto py-12">
      <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center">
        <div class="w-full order-2 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-1/2 relative">
          <?php if ($subscribe_image) : ?>
            <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo $subscribe_image['url'] ?>" class="" alt="<?php echo $subscribe_image['alt'] ?>"></div>
          <?php endif ?>
        </div>
        <div class="w-full order-1 lg:w-2/3 xl:w-1/2 pt-10">
          <?php if ($subscribe_heading) : ?>
            <div class="not-prose">
              <h3 class="mb-8 xl:mb-8 text-left text-[48px] leading-tight font-bold text-white"><?php echo $subscribe_heading ?></h3>
            </div>
          <?php endif ?>
          <?php if ($subscribe_form_shortcode) : ?>
            <?php echo do_shortcode($subscribe_form_shortcode) ?>
          <?php else : ?>
            <div class="subscribe_section-form">
              <style type="text/css">
                /* .elq-form [type=email],
                .elq-form [type=text] {
                  display: block;
                  width: 100%;
                  padding: 0.8125rem 1rem;
                  font-size: .75rem;
                  line-height: 1.16667;
                  color: #000;
                  border: 1px solid hsla(240, 1%, 46%, .2);
                  border-radius: 2px;
                  background-color: #fff;
                  font-weight: normal;
                  -webkit-appearance: none;
                  -moz-appearance: none;
                  appearance: none;
                  -webkit-transition: border-color .25s ease-in-out;
                  transition: border-color .25s ease-in-out;
                  will-change: border-color;
                }
                .elq-form [type=email]:focus,
                .elq-form [type=text]:focus {
                  outline: none;
                  border: 1px solid #b2519e;
                } */

                .LV_invalid_field,
                input.LV_invalid_field:active,
                input.LV_invalid_field:hover,
                textarea.LV_invalid_field:active,
                textarea.LV_invalid_field:hover {
                  outline: 1px solid #c00;
                }

                .LV_validation_message {
                  font-weight: 700;
                  margin: 5px 0 0 0;
                  display: block;
                  text-align: center;
                }

                .LV_valid {
                  display: none
                }

                .LV_invalid {
                  /* color: #c00; */
                  color: #fff;
                  font-size: 10px;
                }

                /* .elq-form [type=submit] {
                  color: #fff;
                  text-align: center;
                  font-family: inherit;
                  padding: 0.6875rem 1.5625rem;
                  border: 2px solid transparent;
                  border-radius: 2px;
                  background-color: #b2519e;
                  font-size: .875rem;
                  line-height: 1;
                  text-decoration: none;
                  display: inline-block;
                  vertical-align: middle;
                  cursor: pointer;
                  margin: 0;
                  -webkit-transition: all .3s cubic-bezier(.74, .25, .01, 1);
                  transition: all .3s cubic-bezier(.74, .25, .01, 1);
                  -webkit-transition-property: background-color, color;
                  transition-property: background-color, color;
                  will-change: background-color, color;
                  -webkit-appearance: none;
                  -moz-appearance: none;
                  appearance: none;
                  outline: 0;
                  width: 100%;
                }

                .elq-form [type=submit]:hover {
                  color: #fff;
                  background-color: #d46bbe;
                } */

                /* @media (min-width: 1024px) {
                  .elq-form .layout {
                    display: flex;
                    flex-wrap: wrap;
                    width: 100%;
                  }

                  .elq-form .layout .form-element-layout {
                    flex-grow: 1;
                  }
                } */
              </style>
              <form method="post" name="copyOfGeneralEnquiryFormWebsite-1669869759180" action="https://s1709896.t.eloqua.com/e/f2" onsubmit="return handleFormSubmit(this)" id="form45" class="elq-form">
                <input value="copyOfGeneralEnquiryFormWebsite-1669869759180" type="hidden" name="elqFormName">
                <input value="1709896" type="hidden" name="elqSiteId">
                <input name="elqCampaignId" type="hidden">
                <div class="layout grid grid-cols-2 gap-3">
                  <div id="formElement0" class="elq-field-style form-element-layout">
                    <div class="field-control-wrapper">
                      <input type="text" class="elq-item-input bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50 focus:ring-white/20" name="firstName" id="fe699" value="" placeholder="First Name *" style="width:100%;">
                    </div>
                  </div>
                  <div id="formElement1" class="elq-field-style form-element-layout">
                    <div class="field-control-wrapper">
                      <input type="text" class="elq-item-input bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50 focus:ring-white/20" name="lastName" id="fe700" value="" placeholder="Last Name *" style="width:100%;">
                    </div>
                  </div>
                  <div id="formElement2" class="elq-field-style form-element-layout">
                    <div class="field-control-wrapper">
                      <input type="text" class="elq-item-input bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50 focus:ring-white/20" name="emailAddress" id="fe701" value="" placeholder="Email Address *" style="width:100%;">
                    </div>
                  </div>
                  <div id="formElement3" class="elq-field-style form-element-layout">
                    <div class="field-control-wrapper">
                      <input type="text" class="elq-item-input bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50 focus:ring-white/20" name="zipPostal" id="fe734" value="" placeholder="Post Code *" style="width:100%;">
                    </div>
                  </div>
                </div>
                <div class="my-6">
                  <div id="formElement4" class="elq-field-style form-element-layout">
                    <div class="field-control-wrapper">
                      <input type="Submit" class="submit-button-style bg-white cursor-pointer px-12 py-3 rounded-full text-black font-medium hover:shadow-lg" value="Subscribe" id="fe705">
                    </div>
                  </div>
                  <input type="hidden" name="utm_source" id="fe706" value="Website">
                </div>
              </form>
              <script type="text/javascript" src="https://img07.en25.com/i/livevalidation_standalone.compressed.js">
              </script>
              <script>
                function handleFormSubmit(ele) {
                  var submitButton = ele.querySelector('input[type=submit]');
                  var spinner = document.createElement('span');
                  spinner.setAttribute('class', 'loader');
                  submitButton.setAttribute('disabled', true);
                  submitButton.style.cursor = 'wait';
                  submitButton.parentNode.appendChild(spinner);
                  return true;
                }

                function resetSubmitButton(e) {
                  var submitButtons = e.target.form.getElementsByClassName('submit-button');
                  for (var i = 0; i < submitButtons.length; i++) {
                    submitButtons[i].disabled = false;
                  }
                }

                function addChangeHandler(elements) {
                  for (var i = 0; i < elements.length; i++) {
                    elements[i].addEventListener('change', resetSubmitButton);
                  }
                }
                var form = document.getElementById('form45');
                addChangeHandler(form.getElementsByTagName('input'));
                addChangeHandler(form.getElementsByTagName('select'));
                addChangeHandler(form.getElementsByTagName('textarea'));
                var nodes = document.querySelectorAll('#form45 input[data-subscription]');
                if (nodes) {
                  for (var i = 0, len = nodes.length; i < len; i++) {
                    var status = nodes[i].dataset ? nodes[i].dataset.subscription : nodes[i].getAttribute('data-subscription');
                    if (status === 'true') {
                      nodes[i].checked = true;
                    }
                  }
                };
                var nodes = document.querySelectorAll('#form45 select[data-value]');
                if (nodes) {
                  for (var i = 0; i < nodes.length; i++) {
                    var node = nodes[i];
                    var selectedValue = node.dataset ? node.dataset.value : node.getAttribute('data-value');
                    if (selectedValue) {
                      for (var j = 0; j < node.options.length; j++) {
                        if (node.options[j].value === selectedValue) {
                          node.options[j].selected = 'selected';
                          break;
                        }
                      }
                    }
                  }
                }
                this.getParentElement = function(list) {
                  return list[list.length - 1].parentElement
                };
                var dom0 = document.querySelector('#form45 #fe699');
                var fe699 = new LiveValidation(dom0, {
                  validMessage: "",
                  onlyOnBlur: false,
                  wait: 300,
                  isPhoneField: false
                });
                fe699.add(Validate.Custom, {
                  against: function(value) {
                    return !value.match(/(telnet|ftp|https?):\/\/(?:[a-z0-9][a-z0-9-]{0,61}[a-z0-9]\.|[a-z0-9]\.)+[a-z]{2,63}/i);
                  },
                  failureMessage: "Value must not contain any URL's"
                });
                fe699.add(Validate.Custom, {
                  against: function(value) {
                    return !value.match(/(<([^>]+)>)/ig);
                  },
                  failureMessage: "Value must not contain any HTML"
                });
                fe699.add(Validate.Length, {
                  tooShortMessage: "Invalid length for field value",
                  tooLongMessage: "Invalid length for field value",
                  minimum: 0,
                  maximum: 35
                });
                fe699.add(Validate.Presence, {
                  failureMessage: "This field is required"
                });
                var dom1 = document.querySelector('#form45 #fe700');
                var fe700 = new LiveValidation(dom1, {
                  validMessage: "",
                  onlyOnBlur: false,
                  wait: 300,
                  isPhoneField: false
                });
                fe700.add(Validate.Custom, {
                  against: function(value) {
                    return !value.match(/(telnet|ftp|https?):\/\/(?:[a-z0-9][a-z0-9-]{0,61}[a-z0-9]\.|[a-z0-9]\.)+[a-z]{2,63}/i);
                  },
                  failureMessage: "Value must not contain any URL's"
                });
                fe700.add(Validate.Custom, {
                  against: function(value) {
                    return !value.match(/(<([^>]+)>)/ig);
                  },
                  failureMessage: "Value must not contain any HTML"
                });
                fe700.add(Validate.Length, {
                  tooShortMessage: "Invalid length for field value",
                  tooLongMessage: "Invalid length for field value",
                  minimum: 0,
                  maximum: 35
                });
                fe700.add(Validate.Presence, {
                  failureMessage: "This field is required"
                });
                var dom2 = document.querySelector('#form45 #fe701');
                var fe701 = new LiveValidation(dom2, {
                  validMessage: "",
                  onlyOnBlur: false,
                  wait: 300,
                  isPhoneField: false
                });
                fe701.add(Validate.Format, {
                  pattern: /(^[A-Z0-9!#\$%&'\*\+\-\/=\?\^_`\{\|\}~][A-Z0-9!#\$%&'\*\+\-\/=\?\^_`\{\|\}~\.]{0,62}@(([A-Z0-9](?:[A-Z0-9\-]{0,61}[A-Z0-9])?)(\.[A-Z0-9](?:[A-Z0-9\-]{0,61}[A-Z0-9])?)+)$)/i,
                  failureMessage: "A valid email address is required"
                });
                fe701.add(Validate.Format, {
                  pattern: /\.\.|\.@/i,
                  failureMessage: "A valid email address is required",
                  negate: "true"
                });
                fe701.add(Validate.Presence, {
                  failureMessage: "This field is required"
                });
                var dom3 = document.querySelector('#form45 #fe734');
                var fe734 = new LiveValidation(dom3, {
                  validMessage: "",
                  onlyOnBlur: false,
                  wait: 300,
                  isPhoneField: false
                });
                fe734.add(Validate.Custom, {
                  against: function(value) {
                    return !value.match(/(telnet|ftp|https?):\/\/(?:[a-z0-9][a-z0-9-]{0,61}[a-z0-9]\.|[a-z0-9]\.)+[a-z]{2,63}/i);
                  },
                  failureMessage: "Value must not contain any URL's"
                });
                fe734.add(Validate.Custom, {
                  against: function(value) {
                    return !value.match(/(<([^>]+)>)/ig);
                  },
                  failureMessage: "Value must not contain any HTML"
                });
                fe734.add(Validate.Length, {
                  tooShortMessage: "Invalid length for field value",
                  tooLongMessage: "Invalid length for field value",
                  minimum: 0,
                  maximum: 35
                });
                fe734.add(Validate.Presence, {
                  failureMessage: "This field is required"
                });
              </script>
            </div>
            <!-- <div class="my-6">
              <div class="grid grid-cols-2 gap-3">
                <input type="text" placeholder="First name*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
                <input type="text" placeholder="Last name*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
                <input type="text" placeholder="Email*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
                <input type="text" placeholder="Postcode*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
              </div>
              <div class="mt-3">
                <button type="button" class="bg-white px-12 py-3 rounded-full text-black font-medium hover:shadow-lg">Subscribe</button>
              </div>
            </div> -->
          <?php endif ?>
          <?php if ($subscribe_desciption) : ?>
            <div class="prose max-w-none leading-snug mr-auto text-left mb-6 xl:mb-6 text-white">
              <?php echo $subscribe_desciption ?>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<section class="bg-brand-light-gray">
  <div class="relative container max-w-screen-xxl mx-auto py-16">
    <?php if ($columns) : ?>
      <div class="grid grid-cols-<?php echo $column_count ?> gap-12">
        <?php foreach ($columns as $column) : ?>
          <div>
            <?php
            $flag_images = $column['flag_images'];
            $title = $column['title'];
            $description = $column['description'];
            if ($flag_images) :
              echo '<div class="flex gap-x-4 mb-6">';
              foreach ($flag_images as $key => $flag) {
                echo '<img src="' . $flag['url'] . '" alt="' . $flag['alt'] . '">';
              }
              echo '</div>';
            endif;
            if ($title) {
              echo '<h4 class="font-bold font-poppins my-3">' . $title . '</h4>';
            }
            if ($description) {
              echo '<div class="text-sm">' . $description . '</div>';
            }
            ?>
          </div>
        <?php endforeach ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<div class="bg-brand-black py-28">
  <div class="mx-auto max-w-screen-4xl px-4 relative">
    <div class="flex gap-x-24">
      <div class="w-1/4">
        <?php if ($logo) : ?>
          <a href="<?php echo site_url() ?>"><img src="<?php echo $logo['url'] ?>" alt="CoAct" class="h-[128px] w-auto"></a>
        <?php else : ?>
          <a href="<?php echo site_url() ?>"><img src="<?php echo coact_asset('images/logo/logo-coact-white.svg') ?>" alt="CoAct" class="h-[128px] w-auto"></a>
        <?php endif; ?>
        <div class="text-white mt-6">
          <?php if ($address_heading) : ?>
            <h5 class="text-lg font-bold"><?php echo $address_heading ?></h5>
          <?php endif; ?>
          <div class="text-sm">
            <?php if ($address) : ?>
              <?php echo $address ?><br />
            <?php endif; ?>
            <?php if ($phone) : ?>
            <?php endif; ?>
            <strong>Freecall:</strong> <a href="<?php echo $phone['url'] ?>" class="hover:underline"><?php echo $phone['title'] ?></a> &nbsp;&nbsp;<span class="text-brand-sea">|</span>
            <?php if ($email) : ?>
              &nbsp;&nbsp; <strong>Email:</strong> <a href="<?php echo $email['url'] ?>" class="hover:underline"><?php echo $email['title'] ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-x-16">
        <div class="px-6 relative">
          <div class="h-28 w-px bg-brand-sea absolute top-0 left-0"></div>
          <?php if ($popular_heading) : ?>
            <h5 class="text-brand-sea font-bold text-2xl mb-4"><?php echo $popular_heading ?></h5>
          <?php endif; ?>
          <?php if ($popular_links) : ?>
            <ul class="flex flex-col gap-3 text-white">
              <?php foreach ($popular_links as $link) : ?>
                <li class="">
                  <?php if ($link['link']) : ?>
                    <div><a href="<?php echo $link['link']['url'] ?>" class="hover:underline"><?php echo $link['link']['title'] ?></a></div>
                  <?php endif; ?>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif; ?>
        </div>
        <div class="px-6 relative">
          <div class="h-28 w-px bg-brand-sea absolute top-0 left-0"></div>
          <?php if ($connect_heading) : ?>
            <h5 class="text-brand-sea font-bold text-2xl mb-4"><?php echo $connect_heading ?></h5>
          <?php endif; ?>
          <?php if ($connect_links) : ?>
            <ul class="flex flex-col gap-3 text-white">
              <?php foreach ($connect_links as $link) : ?>
                <li class="flex gap-x-4">
                  <?php if ($link['icon']) : ?>
                    <div class="flex-none"><?php echo coact_icon(array('icon' => $link['icon'], 'group' => 'content', 'size' => '24', 'class' => 'mx-auto')); ?></div>
                  <?php endif; ?>
                  <?php if ($link['link']) : ?>
                    <div><a href="<?php echo $link['link']['url'] ?>" class="hover:underline"><?php echo $link['link']['title'] ?></a></div>
                  <?php endif; ?>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif; ?>
        </div>
        <div class="px-6 relative">
          <div class="h-28 w-px bg-brand-sea absolute top-0 left-0"></div>
          <?php if ($quick_links_heading) : ?>
            <h5 class="text-brand-sea font-bold text-2xl mb-4"><?php echo $quick_links_heading ?></h5>
          <?php endif; ?>
          <?php if ($quick_links_links) : ?>
            <ul class="flex flex-col gap-3 text-white">
              <?php foreach ($quick_links_links as $link) : ?>
                <li class="">
                  <?php if ($link['link']) : ?>
                    <div><a href="<?php echo $link['link']['url'] ?>" class="hover:underline"><?php echo $link['link']['title'] ?></a></div>
                  <?php endif; ?>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="bg-brand-sea">
  <div class="mx-auto max-w-screen-4xl px-4 py-4 relative">
    <div class="flex justify-between text-white">
      <?php if ($copyright_site_name) : ?>
        <div class="font-bold">&copy; <?php echo date('Y') ?> <?php echo $copyright_site_name ?></div>
      <?php endif ?>
      <?php if ($copyright_site_name) : ?>
        <div>
          <?php foreach ($copyright_links as $link) : ?>
            <a href="<?php echo $link['link']['url'] ?>" target="<?php echo $link['link']['target'] ?>" class="hover:underline font-semibold"><?php echo $link['link']['title'] ?></a>
          <?php endforeach ?>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>

</footer>