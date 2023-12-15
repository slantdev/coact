<?php

/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 */

get_header();
?>

<!-- Hero Banner -->
<section class="bg-gradient-to-b from-brand-light-gray from-90% via-white via-90% to-white">
  <div class="max-w-screen-5xl px-4 mx-auto">
    <div class="aspect-w-16 aspect-h-7 rounded-3xl overflow-hidden">
      <div class="bg-zinc-300 w-full h-full">
        <img class="object-cover" src="<?php echo coact_asset('images/banner/banner-1.jpg') ?>" alt="">
        <div class="absolute inset-0 flex items-center p-12">
          <div class="w-1/2 font-montserrat">
            <h2 class="text-[64px] text-brand-black font-bold mb-4">Help to find <span class="text-brand-sea">jobs</span></h2>
            <div class="text-2xl font-medium mt-4">
              Get the right job sooner through Disability Employment Services (DES) or Workforce Australia (WFA)
            </div>
            <div class="flex gap-x-4 mt-8">
              <a href="#" class="px-6 py-3 rounded-full border border-solid font-semibold font-poppins text-xl bg-brand-sea border-transparent text-white">Register for DES</a>
              <a href="#" class="px-6 py-3 rounded-full border border-solid font-semibold font-poppins text-xl bg-transparent border-brand-purple text-brand-purple">Find your local CoAct Provider</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Text Center -->
<section class="bg-white relative">
  <div class="relative max-w-screen-4xl h-1">
    <div class="absolute top-0 right-0">
      <?php echo coact_svg(array('svg' => 'shape-1', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-orange w-[500px] h-auto')); ?>
    </div>
  </div>
  <div class="max-w-screen-lg text-center pt-[180px] pb-20 mx-auto relative z-[1]">
    <h3 class="text-brand-sea text-3xl font-bold">CoAct is a leading national partnership of for-purpose Service Partners working together to provide effective staffing solutions that help businesses grow and stay in their communities.</h3>
    <div class="mt-6 text-lg font-medium">The power of many is a proven collaborative model focussed on helping you find the right talent for your business. With over 20 years’ experience, we can help you find the right fit sooner because we have more people working to help you.</div>
  </div>
</section>

<!-- Card Hover -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 xl:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div>
      <div class="not-prose">
        <h3 class="mt-4 xl:mt-8 mb-4 xl:mb-8 text-center text-4xl font-bold">Get started with</h3>
      </div>
    </div>
    <div class="px-12 lg:px-14 relative -mx-2 lg:-mx-0">
      <div id="case-studies-filter" class="swiper mt-10 px-2 pt-2 pb-4 swiper-initialized swiper-horizontal swiper-pointer-events">
        <div class="swiper-wrapper filter-case-study-buttons" id="swiper-wrapper-98301056e5f198879" aria-live="polite">
          <div class="swiper-slide w-auto swiper-slide-active" role="group" aria-label="1 / 18" style="margin-right: 30px;"><button type="button" class="filter-case-study filter-active inline-block rounded-full px-6 py-1.5 h-9 lg:h-auto text-sm lg:text-base lg:px-10 lg:py-2.5 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200" data-id="all" data-postsperpage="9">All</button></div>
          <div class="swiper-slide w-auto swiper-slide-next" role="group" aria-label="2 / 18" style="margin-right: 30px;"><button type="button" class="filter-case-study inline-block rounded-full px-6 py-1.5 h-9 lg:h-auto text-sm lg:text-base lg:px-10 lg:py-2.5 bg-white border border-neutral-100 shadow-md hover:shadow-lg transition-all duration-200" data-id="7" data-postsperpage="9">Disability Employment Services</button></div>
          <div class="swiper-slide w-auto" role="group" aria-label="3 / 18" style="margin-right: 30px;"><button type="button" class="filter-case-study inline-block rounded-full px-6 py-1.5 h-9 lg:h-auto text-sm lg:text-base lg:px-10 lg:py-2.5 bg-white border border-neutral-100 shadow-md hover:shadow-lg transition-all duration-200" data-id="8" data-postsperpage="9">Transition to Work</button></div>
          <div class="swiper-slide w-auto" role="group" aria-label="4 / 18" style="margin-right: 30px;"><button type="button" class="filter-case-study inline-block rounded-full px-6 py-1.5 h-9 lg:h-auto text-sm lg:text-base lg:px-10 lg:py-2.5 bg-white border border-neutral-100 shadow-md hover:shadow-lg transition-all duration-200" data-id="9" data-postsperpage="9">Indigenous employment</button></div>
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
      </div>
      <button type="button" class="casestudy-filter--button-prev absolute left-0 top-2 lg:top-[12px] w-9 h-9 lg:w-10 lg:h-10 flex items-center justify-center bg-white rounded-full shadow-md hover:bg-brand-sea text-gray-500 hover:text-white transition-all duration-200 swiper-button-disabled" disabled="" tabindex="-1" aria-label="Previous slide" aria-controls="swiper-wrapper-98301056e5f198879" aria-disabled="true">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.49994 1.00001C7.63154 0.999249 7.76201 1.02447 7.88384 1.07424C8.00568 1.124 8.1165 1.19733 8.20994 1.29001C8.30367 1.38297 8.37806 1.49357 8.42883 1.61543C8.4796 1.73729 8.50574 1.868 8.50574 2.00001C8.50574 2.13202 8.4796 2.26273 8.42883 2.38459C8.37806 2.50645 8.30367 2.61705 8.20994 2.71001L4.89994 6.00001L8.07994 9.31001C8.26619 9.49737 8.37073 9.75082 8.37073 10.015C8.37073 10.2792 8.26619 10.5326 8.07994 10.72C7.98698 10.8137 7.87637 10.8881 7.75452 10.9389C7.63266 10.9897 7.50195 11.0158 7.36994 11.0158C7.23793 11.0158 7.10722 10.9897 6.98536 10.9389C6.8635 10.8881 6.7529 10.8137 6.65994 10.72L2.79994 6.72001C2.61671 6.53308 2.51408 6.28176 2.51408 6.02001C2.51408 5.75826 2.61671 5.50694 2.79994 5.32001L6.79994 1.32001C6.8897 1.22308 6.99777 1.14489 7.11792 1.08997C7.23807 1.03504 7.36791 1.00447 7.49994 1.00001V1.00001Z" fill="currentColor"></path>
        </svg>
      </button>
      <button type="button" class="casestudy-filter--button-next absolute right-0 top-2 lg:top-[12px] w-9 h-9 lg:w-10 lg:h-10 flex items-center justify-center bg-white rounded-full shadow-md hover:bg-brand-sea text-gray-500 hover:text-white transition-all duration-200" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-98301056e5f198879" aria-disabled="false">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4.49994 11C4.36833 11.0008 4.23787 10.9755 4.11603 10.9258C3.9942 10.876 3.88338 10.8027 3.78994 10.71C3.69621 10.617 3.62182 10.5064 3.57105 10.3846C3.52028 10.2627 3.49414 10.132 3.49414 9.99999C3.49414 9.86798 3.52028 9.73727 3.57105 9.61541C3.62182 9.49355 3.69621 9.38295 3.78994 9.28999L7.09994 5.99999L3.91994 2.68999C3.73369 2.50263 3.62915 2.24918 3.62915 1.98499C3.62915 1.7208 3.73369 1.46735 3.91994 1.27999C4.0129 1.18626 4.1235 1.11187 4.24536 1.0611C4.36722 1.01033 4.49793 0.984192 4.62994 0.984192C4.76195 0.984192 4.89266 1.01033 5.01452 1.0611C5.13638 1.11187 5.24698 1.18626 5.33994 1.27999L9.19994 5.27999C9.38317 5.46692 9.4858 5.71824 9.4858 5.97999C9.4858 6.24174 9.38317 6.49306 9.19994 6.67999L5.19994 10.68C5.11018 10.7769 5.00211 10.8551 4.88196 10.91C4.76181 10.965 4.63197 10.9955 4.49994 11V11Z" fill="currentColor"></path>
        </svg>
      </button>
    </div>
    <script>
      const case_studies_filter = new Swiper('#case-studies-filter', {
        slidesPerView: 'auto',
        spaceBetween: 12,
        loop: false,
        watchOverflow: true,
        centerInsufficientSlides: true,
        navigation: {
          nextEl: '.casestudy-filter--button-next',
          prevEl: '.casestudy-filter--button-prev',
        },
        breakpoints: {
          768: {
            slidesPerView: 'auto',
            spaceBetween: 24
          },
          1280: {
            slidesPerView: 'auto',
            spaceBetween: 30
          }
        }
      });
    </script>
    <div class="filter-case-study-loader pt-2 pb-4">
      <div class="flex items-center justify-center">
        <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 text-fiap-teal rounded-full opacity-0" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
    <div class="case-study-grid relative">
      <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-6 lg:gap-8 2xl:gap-10">
        <a href="#" class="card-hover h-full rounded-xl bg-slate-100 relative overflow-hidden cursor-pointer shadow-md">
          <div class="aspect-w-1 aspect-h-1"><img class="card-image object-center object-cover" src="https://picsum.photos/400/300?random=16"></div>
          <div class="card-text">
            <h3 class="card-title">Workforce Australia is the new system to help you find a job</h3>
            <div class="card-excerpt">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ullamcorper eu, nunc adipiscing risus sit tristique eget lacinia. Lacus, velit eget molestie quis tellus neque, vel, consectetur.
            </div>
            <button type="button" class="bg-white p-4 absolute right-6 bottom-6 rounded-full w-8 h-8 xl:w-12 xl:h-12">
              <span class="block w-4 h-1 bg-brand-sea absolute top-1/2 -translate-y-1/2"></span>
              <span class="block w-1 h-4 bg-brand-sea absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2"></span>
            </button>
          </div>
        </a>
        <a href="#" class="card-hover h-full rounded-xl bg-slate-100 relative overflow-hidden cursor-pointer shadow-md">
          <div class="aspect-w-1 aspect-h-1"><img class="card-image object-center object-cover" src="https://picsum.photos/400/300?random=17"></div>
          <div class="card-text">
            <h3 class="card-title">What is Workforce Australia?</h3>
            <div class="card-excerpt">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ullamcorper eu, nunc adipiscing risus sit tristique eget lacinia. Lacus, velit eget molestie quis tellus neque, vel, consectetur.
            </div>
            <button type="button" class="bg-white p-4 absolute right-6 bottom-6 rounded-full w-8 h-8 xl:w-12 xl:h-12">
              <span class="block w-4 h-1 bg-brand-sea absolute top-1/2 -translate-y-1/2"></span>
              <span class="block w-1 h-4 bg-brand-sea absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2"></span>
            </button>
          </div>
        </a>
        <a href="#" class="card-hover h-full rounded-xl bg-slate-100 relative overflow-hidden cursor-pointer shadow-md">
          <div class="aspect-w-1 aspect-h-1"><img class="card-image object-center object-cover" src="https://picsum.photos/400/300?random=18"></div>
          <div class="card-text">
            <h3 class="card-title">Why choose CoAct Employment Services?</h3>
            <div class="card-excerpt">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ullamcorper eu, nunc adipiscing risus sit tristique eget lacinia. Lacus, velit eget molestie quis tellus neque, vel, consectetur.
            </div>
            <button type="button" class="bg-white p-4 absolute right-6 bottom-6 rounded-full w-8 h-8 xl:w-12 xl:h-12">
              <span class="block w-4 h-1 bg-brand-sea absolute top-1/2 -translate-y-1/2"></span>
              <span class="block w-1 h-4 bg-brand-sea absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2"></span>
            </button>
          </div>
        </a>
      </div>
      <div class="blocker absolute inset-0 bg-white bg-opacity-40" style="display: none;"></div>
    </div>
  </div>
</section>

<!-- Icon Numbers -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="grid grid-cols-3 divide-x divide-brand-purple">
      <div class="text-center py-4 px-8">
        <div class="mb-4">
          <?php echo coact_icon(array('icon' => 'thumb', 'group' => 'content', 'size' => '96', 'class' => 'text-brand-purple mx-auto')); ?>
        </div>
        <div class="text-brand-purple text-6xl font-bold mb-4">87% NPS</div>
        <div class="text-2xl font-medium">Job seekers recommend CoAct</div>
      </div>
      <div class="text-center py-4 px-8">
        <div class="mb-4">
          <?php echo coact_icon(array('icon' => 'target', 'group' => 'content', 'size' => '96', 'class' => 'text-brand-purple mx-auto')); ?>
        </div>
        <div class="text-brand-purple text-6xl font-bold mb-4">47,354</div>
        <div class="text-2xl font-medium">Jobs placed across the CoAct network</div>
      </div>
      <div class="text-center py-4 px-8">
        <div class="mb-4">
          <?php echo coact_icon(array('icon' => 'people', 'group' => 'content', 'size' => '96', 'class' => 'text-brand-purple mx-auto')); ?>
        </div>
        <div class="text-brand-purple text-6xl font-bold mb-4">$17,696,177</div>
        <div class="text-2xl font-medium">Invested into job seekers nationally</div>
      </div>
    </div>
  </div>
</section>

<!-- Card Category -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="absolute top-0 left-0 rounded-full bg-brand-yellow w-[528px] h-[528px] -translate-x-1/2"></div>
    <div class="relative z-10">
      <div>
        <div>
          <div class="not-prose">
            <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">Who we help</h3>
          </div>
        </div>
        <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
          <div class="w-full lg:w-2/3">
            <div class="prose xl:prose-lg mr-auto text-left">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
            </div>
          </div>
          <div class="w-full lg:w-1/3 text-right">
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">Talk to us</a>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-5">
        <a class="relative block">
          <div class="aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=1" alt="" class="object-cover">
          </div>
          <div class="absolute bottom-0 left-0 right-0">
            <div class="mb-4 ml-4">
              <div class="inline-block bg-white rounded-lg py-3 px-4 font-bold">Job Seekers</div>
            </div>
          </div>
        </a>
        <a class="relative block">
          <div class="aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=2" alt="" class="object-cover">
          </div>
          <div class="absolute bottom-0 left-0 right-0">
            <div class="mb-4 ml-4">
              <div class="inline-block bg-white rounded-lg py-3 px-4 font-bold">People with Disability, Illness & Injury</div>
            </div>
          </div>
        </a>
        <a class="relative block">
          <div class="aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=3" alt="" class="object-cover">
          </div>
          <div class="absolute bottom-0 left-0 right-0">
            <div class="mb-4 ml-4">
              <div class="inline-block bg-white rounded-lg py-3 px-4 font-bold">Unemployed</div>
            </div>
          </div>
        </a>
        <a class="relative block">
          <div class="aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=4" alt="" class="object-cover">
          </div>
          <div class="absolute bottom-0 left-0 right-0">
            <div class="mb-4 ml-4">
              <div class="inline-block bg-white rounded-lg py-3 px-4 font-bold">NDIS Participants</div>
            </div>
          </div>
        </a>
        <a class="relative block">
          <div class="aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=5" alt="" class="object-cover">
          </div>
          <div class="absolute bottom-0 left-0 right-0">
            <div class="mb-4 ml-4">
              <div class="inline-block bg-white rounded-lg py-3 px-4 font-bold">Centrelink</div>
            </div>
          </div>
        </a>
        <a class="relative block">
          <div class="aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=6" alt="" class="object-cover">
          </div>
          <div class="absolute bottom-0 left-0 right-0">
            <div class="mb-4 ml-4">
              <div class="inline-block bg-white rounded-lg py-3 px-4 font-bold">Regional</div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Image Left + Text -->
<section class="bg-white">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
        <div class="absolute top-0 -left-1/2 -translate-x-[15%]">
          <?php echo coact_svg(array('svg' => 'shape-2', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-sea w-[660px] h-auto')); ?>
        </div>
        <div class="mb-8 mx-auto xl:mb-12 max-w-full aspect-w-1 aspect-h-1 rounded-full overflow-hidden"><img width="989" height="659" src="https://picsum.photos/400/300?random=15" class="rounded-full mx-auto h-full w-full object-center object-cover" alt=""></div>
      </div>
      <div class="w-full order-2 lg:w-2/3 xl:w-3/5 pt-10">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold">How CoAct can help you</h3>
        </div>
        <div class="prose prose-xl max-w-none font-medium mb-6">
          With a network of Service Partners across the country, we work together to deliver you the best possible outcome – the right job sooner.
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <div class="mb-6 xl:mb-0 mt-6 xl:mt-12 text-left"><a href="#" class="inline-block text-lg font-bold underline ">Discover the CoAct difference</a></div>
      </div>
    </div>
  </div>
</section>

<!-- Logo Carousel -->
<section class="relative">
  <div class="relative pt-4 lg:pt-6 xl:pt-14 pb-4 lg:pb-6 xl:pb-24">
    <div class="text-center max-w-prose mx-auto mb-14">
      <div class="not-prose">
        <h3 class="mb-8 xl:mb-12 text-4xl font-bold">Our partners</h3>
      </div>
      <div class="prose prose-xl max-w-none font-medium mb-6">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </div>
    </div>
    <div class="py-6 lg:py-0 mt-20 container mx-auto">
      <div id="carousel-657b59f1e24b5" class="swiper px-16" style="--swiper-navigation-color: #45C2BF; --swiper-navigation-size: 24px">
        <div class="swiper-wrapper items-center" id="swiper-wrapper-a3910648f7f6e8a32">
          <div class="swiper-slide">
            <div class="flex flex-col items-center justify-center">
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="82" height="40" fill="none" viewBox="0 0 82 40">
                  <path fill="#FFD43D" d="M73.365 19.71c0 2.904-2.241 5.31-5.27 5.31-3.03 0-5.228-2.406-5.228-5.31 0-2.905 2.199-5.312 5.228-5.312s5.27 2.407 5.27 5.311Z"></path>
                  <path fill="#FF0C81" d="M48.764 19.544c0 2.946-2.323 5.145-5.27 5.145-2.904 0-5.227-2.2-5.227-5.145 0-2.947 2.323-5.104 5.228-5.104 2.946 0 5.27 2.158 5.27 5.104Z"></path>
                  <path fill="#11EEFC" d="M20.074 25.02c3.029 0 5.27-2.406 5.27-5.31 0-2.905-2.241-5.312-5.27-5.312-3.03 0-5.228 2.407-5.228 5.311 0 2.905 2.199 5.312 5.228 5.312Z"></path>
                  <path fill="#171A26" d="M68.095 30.54c-6.307 0-11.12-4.897-11.12-10.872 0-5.934 4.855-10.83 11.12-10.83 6.349 0 11.162 4.938 11.162 10.83 0 5.975-4.855 10.871-11.162 10.871Zm0-5.52c3.03 0 5.27-2.406 5.27-5.31 0-2.905-2.24-5.312-5.27-5.312-3.029 0-5.228 2.407-5.228 5.311 0 2.905 2.199 5.312 5.228 5.312ZM43.08 40c-4.813 0-8.506-2.116-10.373-5.934l4.896-2.655c.913 1.784 2.614 3.195 5.394 3.195 3.486 0 5.85-2.448 5.85-6.473v-.374c-1.12 1.411-3.111 2.49-6.016 2.49-5.768 0-10.373-4.481-10.373-10.581 0-5.934 4.813-10.788 11.12-10.788 6.431 0 11.162 4.605 11.162 10.788v8.299C54.74 35.27 49.76 40 43.08 40Zm.415-15.311c2.946 0 5.27-2.2 5.27-5.145 0-2.947-2.324-5.104-5.27-5.104-2.905 0-5.228 2.158-5.228 5.104s2.323 5.145 5.228 5.145ZM20.074 30.54c-6.307 0-11.12-4.897-11.12-10.872 0-5.934 4.854-10.83 11.12-10.83 6.348 0 11.162 4.938 11.162 10.83 0 5.975-4.855 10.871-11.162 10.871Zm0-5.52c3.029 0 5.27-2.406 5.27-5.31 0-2.905-2.241-5.312-5.27-5.312-3.03 0-5.228 2.407-5.228 5.311 0 2.905 2.199 5.312 5.228 5.312ZM0 0h5.892v30H0V0ZM82 6.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path>
                </svg></a>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="flex flex-col items-center justify-center">
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="71" height="55" fill="none" viewBox="0 0 71 55">
                  <path fill="#113441" d="M62.883 50.1c.988 0 1.523.734 1.523 1.642v1.723h-.662v-1.616c0-.594-.293-1.115-.908-1.115-.594 0-.894.5-.894 1.102v1.629h-.661v-1.63c0-.6-.3-1.101-.909-1.101-.614 0-.888.52-.888 1.115v1.616h-.66v-1.716c0-.915.52-1.65 1.502-1.65.654 0 1.128.334 1.295.842.18-.508.641-.841 1.262-.841ZM56.498 52.904c.607 0 .941-.528.941-1.135v-1.576h.661v1.656c0 .948-.574 1.696-1.602 1.696-1.015 0-1.59-.755-1.59-1.703v-1.649h.661v1.583c0 .6.328 1.128.929 1.128ZM53.044 53.538c-.608 0-1.075-.24-1.33-.727l.508-.28c.167.326.434.447.795.447.374 0 .661-.154.661-.441 0-.688-1.876-.167-1.876-1.416 0-.574.507-.995 1.222-.995.607 0 1.021.28 1.228.661l-.507.288c-.14-.288-.407-.388-.708-.388-.307 0-.574.16-.574.42 0 .669 1.876.181 1.876 1.416 0 .621-.6 1.015-1.295 1.015ZM48.505 54.967h-.662v-3.145c0-.975.755-1.71 1.743-1.71a1.71 1.71 0 0 1 1.736 1.71c0 .989-.714 1.723-1.71 1.723-.44 0-.84-.194-1.108-.487v1.91Zm1.081-2.043c.608 0 1.075-.5 1.075-1.095 0-.601-.467-1.088-1.075-1.088-.614 0-1.081.487-1.081 1.088 0 .594.467 1.095 1.081 1.095ZM46.306 50.193h.66v3.272h-.66v-3.272ZM55.223 47.207c-5.051 0-8.904-3.885-8.904-8.613 0-4.694 3.853-8.58 8.904-8.58 5.05 0 8.904 3.886 8.904 8.58 0 4.728-3.853 8.613-8.904 8.613Zm0-5.472c1.845 0 3.076-1.425 3.076-3.108 0-1.716-1.23-3.141-3.076-3.141s-3.076 1.425-3.076 3.14c0 1.684 1.23 3.11 3.076 3.11ZM35.314 54.654c-4.015 0-6.93-1.78-8.419-4.954l4.825-2.59c.518 1.1 1.49 2.234 3.497 2.234 2.104 0 3.497-1.328 3.659-3.659-.778.68-2.008 1.198-3.853 1.198-4.501 0-8.128-3.464-8.128-8.321 0-4.695 3.854-8.515 8.905-8.515 5.18 0 8.904 3.594 8.904 8.547v6.411c0 5.828-4.048 9.649-9.39 9.649Zm.388-13.243c1.749 0 3.076-1.198 3.076-2.979 0-1.748-1.327-2.914-3.076-2.914-1.716 0-3.075 1.166-3.075 2.914 0 1.781 1.36 2.98 3.075 2.98ZM17.009 47.207c-5.051 0-8.904-3.885-8.904-8.613 0-4.694 3.853-8.58 8.904-8.58 5.05 0 8.904 3.886 8.904 8.58 0 4.728-3.853 8.613-8.904 8.613Zm0-5.472c1.845 0 3.076-1.425 3.076-3.108 0-1.716-1.23-3.141-3.076-3.141s-3.076 1.425-3.076 3.14c0 1.684 1.23 3.11 3.076 3.11ZM0 23.085h5.828v23.636H0V23.085ZM70.734 32a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"></path>
                  <path fill="#FFD43E" fill-rule="evenodd" d="M54.79 9.665a33 33 0 0 1 9.616 21.525 11.867 11.867 0 0 0-6.561-3.9 27 27 0 0 0-50.1-7.205H1.086A33 33 0 0 1 54.79 9.665ZM8.828 30.15Zm7.587-3.122a12.704 12.704 0 0 0 0 0Zm9.986 4.415Zm8.685-4.377a12.784 12.784 0 0 0 0 0Zm10.481 4.719Zm8.911-4.75a12.653 12.653 0 0 0 0 0Z" clip-rule="evenodd"></path>
                  <path fill="#EE8E1D" fill-rule="evenodd" d="M50.547 13.908a27.001 27.001 0 0 1 7.298 13.382c-.842-.18-1.72-.276-2.622-.276-1.22 0-2.394.174-3.497.499a20.999 20.999 0 0 0-40.81 1.108 11.8 11.8 0 0 0-2.088 1.529V20.085H7.744a27 27 0 0 1 42.803-6.177ZM26.401 31.443c-1.761-2.194-4.323-3.746-7.284-4.252 2.96.506 5.523 2.058 7.284 4.252Z" clip-rule="evenodd"></path>
                  <path fill="#971C1C" d="M46.306 30.888a15 15 0 0 0-28.613-3.856c3.56.192 6.67 1.873 8.708 4.411 2.172-2.69 5.563-4.396 9.399-4.396 4.11 0 7.642 1.802 9.767 4.738.231-.311.478-.61.739-.897Z"></path>
                  <path fill="#D62727" fill-rule="evenodd" d="M51.725 27.513a11.85 11.85 0 0 0-5.42 3.375 15 15 0 0 0-28.612-3.856 12.716 12.716 0 0 0-.684-.018c-2.237 0-4.317.586-6.093 1.607a21 21 0 0 1 40.81-1.108Z" clip-rule="evenodd"></path>
                </svg></a>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="flex flex-col items-center justify-center">
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="187" height="40" fill="none" viewBox="0 0 187 40">
                  <path fill="#3A724F" fill-rule="evenodd" d="M19.87 4.567 22.507 0l7.476 4.317-2.636 4.566c-.463.801.23 1.775 1.138 1.6l5.052-.975 1.635 8.477-5.052.974c-8.172 1.576-14.411-7.184-10.25-14.392Z" clip-rule="evenodd"></path>
                  <path fill="#DC8E43" fill-rule="evenodd" d="M15.302 35.433 12.665 40l-7.477-4.316 2.637-4.567c.463-.801-.23-1.775-1.139-1.6l-5.051.974L0 22.015l5.052-.974c8.172-1.576 14.41 7.184 10.25 14.392Z" clip-rule="evenodd"></path>
                  <path fill="#14424C" fill-rule="evenodd" d="M15.53 4.567 12.894 0 5.417 4.317l2.637 4.566c.462.801-.23 1.775-1.139 1.6l-5.052-.975L.23 17.985l5.051.974c8.173 1.576 14.412-7.184 10.25-14.392Z" clip-rule="evenodd"></path>
                  <path fill="#C85D1B" fill-rule="evenodd" d="M19.65 35.433 22.285 40l7.477-4.316-2.637-4.567c-.462-.801.23-1.775 1.139-1.6l5.051.974 1.635-8.476-5.052-.974c-8.172-1.576-14.41 7.184-10.25 14.392Z" clip-rule="evenodd"></path>
                  <path fill="#14424C" d="M163.114 30.153v-8.5c0-1.178.271-2.235.813-3.17.561-.954 1.356-1.702 2.385-2.245 1.029-.542 2.254-.813 3.675-.813a7.23 7.23 0 0 1 1.964.252c.599.15 1.141.365 1.627.645.505.262.935.58 1.291.954h.056a5.5 5.5 0 0 1 1.29-.954 6.772 6.772 0 0 1 1.656-.645 7.541 7.541 0 0 1 1.992-.252c1.421 0 2.646.27 3.675.813 1.028.543 1.823 1.29 2.384 2.245.562.935.842 1.991.842 3.17v8.5h-4.377v-8.36c0-.467-.121-.888-.364-1.262a2.663 2.663 0 0 0-.926-.954 2.508 2.508 0 0 0-1.347-.365c-.505 0-.963.122-1.374.365a2.654 2.654 0 0 0-.926.954 2.4 2.4 0 0 0-.337 1.262v8.36h-4.348v-8.36c0-.467-.122-.888-.365-1.262a2.585 2.585 0 0 0-.954-.954 2.508 2.508 0 0 0-1.347-.365c-.505 0-.963.122-1.374.365a2.654 2.654 0 0 0-.926.954 2.41 2.41 0 0 0-.337 1.262v8.36h-4.348ZM153.603 30.49c-1.477 0-2.759-.28-3.843-.842-1.066-.58-1.889-1.356-2.469-2.328-.58-.991-.87-2.086-.87-3.283v-8.276h4.349v8.164c0 .505.121.973.364 1.403.243.411.571.748.982 1.01.43.243.917.365 1.459.365.524 0 .991-.122 1.403-.365.43-.262.767-.599 1.01-1.01.243-.43.365-.898.365-1.403v-8.164h4.348v8.276c0 1.197-.281 2.292-.842 3.283-.561.972-1.374 1.749-2.44 2.328-1.048.561-2.32.842-3.816.842ZM132.414 30.153v-3.45h6.93c.187 0 .355-.038.505-.113.149-.093.271-.215.364-.364a.93.93 0 0 0 0-.982.9.9 0 0 0-.364-.337.934.934 0 0 0-.505-.14h-2.525c-.936 0-1.787-.15-2.553-.449a4.052 4.052 0 0 1-1.796-1.459c-.43-.673-.645-1.543-.645-2.609 0-.823.196-1.571.589-2.244a4.76 4.76 0 0 1 1.655-1.628 4.568 4.568 0 0 1 2.329-.617h6.929v3.479h-6.256a.97.97 0 0 0-.673.253.841.841 0 0 0-.253.617c0 .262.085.486.253.673a.97.97 0 0 0 .673.253h2.469c1.047 0 1.945.159 2.693.476.767.3 1.356.786 1.768 1.46.43.673.645 1.542.645 2.608 0 .842-.215 1.609-.645 2.3a4.613 4.613 0 0 1-1.684 1.656c-.692.412-1.477.617-2.356.617h-7.547ZM122.94 15.425c1.216 0 2.291.196 3.226.589a6.41 6.41 0 0 1 2.413 1.627 6.993 6.993 0 0 1 1.543 2.469c.355.935.533 1.973.533 3.114 0 1.421-.299 2.684-.898 3.787a6.471 6.471 0 0 1-2.412 2.553c-1.029.617-2.226.926-3.591.926-.58 0-1.132-.075-1.656-.224a5.312 5.312 0 0 1-1.402-.646 3.9 3.9 0 0 1-1.038-1.038h-.085v7.66h-4.348V23.223c0-1.59.318-2.965.954-4.124a6.666 6.666 0 0 1 2.693-2.694c1.16-.654 2.516-.981 4.068-.981Zm0 3.759c-.673 0-1.262.168-1.767.505-.487.318-.861.767-1.123 1.347-.261.56-.392 1.197-.392 1.907 0 .711.131 1.347.392 1.908.262.561.636 1.01 1.123 1.347.505.318 1.094.477 1.767.477.673 0 1.253-.16 1.739-.477a3.297 3.297 0 0 0 1.123-1.347c.28-.561.42-1.197.42-1.908 0-.71-.14-1.346-.42-1.907-.262-.58-.636-1.03-1.123-1.347-.486-.337-1.066-.505-1.739-.505ZM108.617 30.153V15.761h4.377v14.392h-4.377Zm2.188-16.019c-.692 0-1.29-.252-1.795-.757-.505-.505-.758-1.104-.758-1.796s.253-1.29.758-1.795c.505-.524 1.103-.786 1.795-.786s1.291.262 1.796.786c.505.505.757 1.103.757 1.795s-.252 1.29-.757 1.796c-.505.505-1.104.757-1.796.757ZM99.105 30.49c-1.477 0-2.805-.327-3.984-.982a7.462 7.462 0 0 1-2.805-2.693c-.673-1.141-1.01-2.422-1.01-3.844 0-1.44.337-2.721 1.01-3.843a7.462 7.462 0 0 1 2.805-2.693c1.179-.674 2.507-1.01 3.984-1.01 1.478 0 2.796.336 3.956 1.01a7.25 7.25 0 0 1 2.777 2.693c.692 1.122 1.038 2.403 1.038 3.843 0 1.422-.346 2.703-1.038 3.844a7.25 7.25 0 0 1-2.777 2.693c-1.178.655-2.497.982-3.956.982Zm0-3.787c.692 0 1.291-.169 1.796-.505a3.424 3.424 0 0 0 1.178-1.347c.281-.561.421-1.197.421-1.908 0-.692-.14-1.318-.421-1.88a3.423 3.423 0 0 0-1.178-1.346c-.505-.337-1.104-.505-1.796-.505s-1.3.168-1.823.505a3.428 3.428 0 0 0-1.179 1.347 4.144 4.144 0 0 0-.42 1.88c0 .71.14 1.346.42 1.907a3.43 3.43 0 0 0 1.179 1.347c.523.336 1.131.505 1.823.505ZM77.174 35.849v-3.732h7.181c.281 0 .515-.093.702-.28a.83.83 0 0 0 .28-.646v-3.17h-.084a6.59 6.59 0 0 1-1.206 1.094c-.412.3-.88.524-1.403.674a6.023 6.023 0 0 1-1.711.224c-1.272 0-2.413-.3-3.423-.898-.991-.617-1.777-1.468-2.357-2.553-.56-1.084-.841-2.319-.841-3.703 0-1.365.29-2.609.87-3.731.598-1.122 1.468-2.02 2.609-2.693 1.14-.674 2.534-1.01 4.18-1.01 1.571 0 2.927.327 4.068.982a6.624 6.624 0 0 1 2.693 2.72c.636 1.16.954 2.526.954 4.097v8.416c0 1.29-.383 2.31-1.15 3.058-.748.767-1.786 1.15-3.114 1.15h-8.248Zm4.825-9.483c.673 0 1.253-.15 1.74-.449a3.18 3.18 0 0 0 1.121-1.262 3.834 3.834 0 0 0 .393-1.74c0-.673-.13-1.29-.392-1.851-.262-.561-.636-1.001-1.123-1.319-.486-.337-1.066-.505-1.74-.505-.654 0-1.234.159-1.739.477-.486.318-.86.748-1.122 1.29-.261.543-.392 1.15-.392 1.824 0 .655.13 1.253.392 1.796.262.523.636.944 1.123 1.262.504.318 1.084.477 1.739.477ZM65.473 30.49c-1.477 0-2.805-.327-3.983-.982a7.46 7.46 0 0 1-2.806-2.693c-.673-1.141-1.01-2.422-1.01-3.844 0-1.44.337-2.721 1.01-3.843a7.46 7.46 0 0 1 2.806-2.693c1.178-.674 2.506-1.01 3.983-1.01 1.478 0 2.796.336 3.956 1.01a7.252 7.252 0 0 1 2.777 2.693c.692 1.122 1.038 2.403 1.038 3.843 0 1.422-.346 2.703-1.038 3.844a7.252 7.252 0 0 1-2.777 2.693c-1.178.655-2.497.982-3.956.982Zm0-3.787c.692 0 1.29-.169 1.796-.505a3.43 3.43 0 0 0 1.178-1.347c.28-.561.42-1.197.42-1.908 0-.692-.14-1.318-.42-1.88a3.429 3.429 0 0 0-1.178-1.346c-.505-.337-1.104-.505-1.796-.505s-1.3.168-1.823.505a3.428 3.428 0 0 0-1.179 1.347 4.145 4.145 0 0 0-.42 1.88c0 .71.14 1.346.42 1.907a3.43 3.43 0 0 0 1.179 1.347c.523.336 1.131.505 1.823.505ZM51.547 30.153c-1.216 0-2.282-.27-3.198-.813a5.763 5.763 0 0 1-2.132-2.16c-.505-.898-.758-1.89-.758-2.974V10.515h4.713v14.027c0 .45.16.842.477 1.179.318.336.71.505 1.178.505h5.19v3.927h-5.47Z"></path>
                </svg></a>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="flex flex-col items-center justify-center">
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="40" fill="none" viewBox="0 0 100 40">
                  <path fill="#1D2633" d="M4.77 4.235C5.03 3.001 6.26 2 7.513 2h6.812L8.66 28.823H1.848c-1.254 0-2.06-1-1.799-2.235L4.77 4.235ZM27.477 4.235C27.738 3.001 28.967 2 30.22 2h6.812l-5.665 26.823h-6.812c-1.254 0-2.06-1-1.799-2.235l4.721-22.353ZM72.892 4.235C73.152 3.001 74.38 2 75.635 2h6.812l-5.665 26.823h-6.813c-1.254 0-2.059-1-1.798-2.235l4.72-22.353ZM39.303 2h6.812c1.254 0 2.06 1 1.799 2.235l-4.721 22.353c-.26 1.235-1.489 2.235-2.743 2.235h-6.812L39.303 2ZM84.718 2h6.812c1.254 0 2.06 1 1.799 2.235l-4.722 22.353c-.26 1.235-1.488 2.235-2.742 2.235h-6.813L84.718 2ZM50.185 4.235C50.445 3.001 51.673 2 52.927 2h6.813l-5.666 26.823h-6.812c-1.254 0-2.06-1-1.798-2.235l4.72-22.353ZM62.01 2h6.813c1.254 0 2.059 1 1.798 2.235l-7.081 33.53C63.278 38.999 62.05 40 60.796 40h-6.813L62.01 2ZM12.819 19.882h9.083l-1.416 6.706c-.261 1.235-1.49 2.235-2.743 2.235H10.93l1.888-8.94ZM44.52 31.059h9.082L51.714 40h-6.812c-1.255 0-2.06-1-1.799-2.235l1.416-6.706ZM69.174 33.138l-1.15 5.446c-.05.234-.128.298-.366.298h-.523c-.238 0-.29-.064-.24-.298l1.15-5.446c.05-.233.128-.298.366-.298h.523c.238 0 .29.065.24.298ZM70.686 36.812h-.107c-.114 0-.154.032-.177.145l-.344 1.627c-.05.234-.129.298-.366.298h-.524c-.237 0-.289-.064-.24-.298l1.15-5.446c.05-.233.13-.298.367-.298h1.08c1.244 0 1.715.443 1.485 1.53l-.192.911c-.23 1.088-.888 1.53-2.132 1.53Zm.316-2.699-.3 1.426c-.025.113.001.145.116.145h.172c.4 0 .615-.161.702-.572l.12-.572c.087-.41-.059-.572-.46-.572h-.172c-.114 0-.154.032-.178.145ZM74.74 34.991l.85.935c.446.483.508.773.394 1.313l-.03.145c-.215 1.015-.727 1.579-1.914 1.579-1.186 0-1.479-.475-1.205-1.773l.034-.16c.05-.234.129-.299.366-.299h.556c.238 0 .29.065.24.298l-.075.355c-.068.322.036.451.322.451.287 0 .443-.12.505-.41l.032-.154c.048-.226.022-.338-.224-.604l-.8-.862c-.448-.475-.505-.75-.391-1.29l.037-.176c.215-1.015.727-1.58 1.913-1.58 1.187 0 1.48.476 1.206 1.773l-.034.161c-.05.234-.129.298-.366.298h-.557c-.237 0-.289-.064-.24-.298l.075-.354c.068-.323-.035-.451-.322-.451-.286 0-.443.12-.504.41l-.029.137c-.05.234-.024.347.161.556ZM79.532 33.138c.05-.233.128-.298.366-.298h.523c.238 0 .29.065.24.298l-.856 4.053c-.274 1.297-.767 1.772-1.954 1.772-1.186 0-1.479-.475-1.205-1.773l.856-4.052c.05-.233.129-.298.366-.298h.524c.237 0 .289.065.24.298l-.897 4.246c-.068.322.044.451.355.451.302 0 .477-.129.545-.451l.897-4.246ZM82.938 36.417c.003.065.024.08.065.08.04 0 .069-.015.099-.08l1.414-3.367c.069-.17.151-.21.356-.21h.794c.237 0 .289.065.24.298l-1.15 5.446c-.05.234-.13.298-.367.298h-.376c-.237 0-.29-.064-.24-.298l.552-2.61c.015-.072.002-.089-.047-.089-.033 0-.07.017-.09.073l-1.142 2.659c-.082.193-.187.265-.424.265H82.4c-.246 0-.32-.072-.32-.265l-.028-2.66c-.005-.056-.018-.072-.059-.072-.049 0-.069.017-.084.089l-.551 2.61c-.05.234-.128.298-.366.298h-.376c-.238 0-.29-.064-.24-.298l1.15-5.446c.05-.233.129-.298.366-.298h.68c.286 0 .378.065.376.347l-.011 3.23ZM100 2c0 1.105-.89 2-1.987 2a1.993 1.993 0 0 1-1.987-2c0-1.105.89-2 1.987-2S100 .895 100 2Z"></path>
                </svg></a>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="flex flex-col items-center justify-center">
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="176" height="40" fill="none" viewBox="0 0 176 40">
                  <path fill="#283841" fill-rule="evenodd" d="M15 28a5 5 0 0 1-5-5V0H0v23c0 8.284 6.716 15 15 15h11V28H15ZM45 10a9 9 0 1 0 0 18 9 9 0 0 0 0-18Zm-19 9C26 8.507 34.507 0 45 0s19 8.507 19 19-8.507 19-19 19-19-8.507-19-19ZM153 10a9 9 0 0 0-9 9 9 9 0 0 0 9 9 9 9 0 0 0 9-9 9 9 0 0 0-9-9Zm-19 9c0-10.493 8.507-19 19-19s19 8.507 19 19-8.507 19-19 19-19-8.507-19-19ZM85 0C74.507 0 66 8.507 66 19s8.507 19 19 19h28c1.969 0 3.868-.3 5.654-.856L124 40l5.768-10.804A19.007 19.007 0 0 0 132 20.261V19c0-10.493-8.507-19-19-19H85Zm37 19a9 9 0 0 0-9-9H85a9 9 0 1 0 0 18h28a9 9 0 0 0 9-8.93V19Z" clip-rule="evenodd"></path>
                  <path fill="#283841" d="M176 2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path>
                </svg></a>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="flex flex-col items-center justify-center">
              <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="54" height="41" fill="none" viewBox="0 0 54 41">
                  <path fill="#2A2E4E" d="M54 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"></path>
                  <path fill="#2A2E4E" fill-rule="evenodd" d="M13.75 40.794C6.156 40.794 0 34.638 0 27.044V1h5v26.044a8.75 8.75 0 0 0 8.75 8.75c4.893 0 8.75-3.771 8.75-8.544h5v7.5a1.25 1.25 0 0 0 2.5 0v-8.875a6.25 6.25 0 0 1-7.5-6.125V7.25a6.25 6.25 0 1 1 12.5 0v27.5a1.25 1.25 0 1 0 2.5 0V7.25a6.25 6.25 0 1 1 12.5 0v27.5a6.25 6.25 0 0 1-10 5A6.222 6.222 0 0 1 36.25 41a6.222 6.222 0 0 1-3.75-1.25 6.251 6.251 0 0 1-9.466-2.47c-2.456 2.197-5.723 3.514-9.284 3.514Zm30-4.794c-.69 0-1.25-.56-1.25-1.25V7.25a1.25 1.25 0 1 1 2.5 0v27.5c0 .69-.56 1.25-1.25 1.25ZM30 19.75a1.25 1.25 0 0 1-2.5 0V7.25a1.25 1.25 0 1 1 2.5 0v12.5Z" clip-rule="evenodd"></path>
                  <path fill="#2A2E4E" fill-rule="evenodd" d="M7.5 27.25a6.25 6.25 0 1 0 12.5 0v-20a6.25 6.25 0 1 0-12.5 0v20Zm6.25 1.25c-.69 0-1.25-.56-1.25-1.25v-20a1.25 1.25 0 1 1 2.5 0v20c0 .69-.56 1.25-1.25 1.25Z" clip-rule="evenodd"></path>
                </svg></a>
            </div>
          </div>
        </div>
        <div class="carousel-657b59f1e24b5--button-prev swiper-button-prev"></div>
        <div class="carousel-657b59f1e24b5--button-next swiper-button-next"></div>
      </div>
      <script>
        new Swiper("#carousel-657b59f1e24b5", {
          slidesPerView: "1",
          spaceBetween: 16,
          watchOverflow: true,
          centerInsufficientSlides: true,
          breakpoints: {
            768: {
              slidesPerView: "3",
              spaceBetween: 32
            },
            1280: {
              slidesPerView: "5",
              spaceBetween: 40
            }
          },
          navigation: {
            nextEl: ".carousel-657b59f1e24b5--button-next",
            prevEl: ".carousel-657b59f1e24b5--button-prev",
          },
          loop: true,
          // autoplay: {
          //   delay: 3000,
          //   disableOnInteraction: false,
          // }
        });
      </script>
    </div>
  </div>
</section>

<!-- Image Left + Text -->
<section class="bg-brand-sea">
  <div class="relative container max-w-screen-xxl mx-auto py-12">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center">
      <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
        <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo coact_asset('images/content/illustration-1.png') ?>" class="" alt=""></div>
      </div>
      <div class="w-full order-2 lg:w-2/3 xl:w-3/5 pt-10">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-8 text-left text-[48px] font-bold text-white">Find your local CoAct Provider</h3>
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-6 text-white">
          <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna erat.</p>
        </div>
        <div class="mb-6 xl:mb-0 mt-6 xl:mt-8 text-left"><a href="#" class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-lg lg:px-10 lg:py-3 bg-white text-brand-sea border border-transparent shadow-md hover:shadow-lg transition-all duration-200">Find Support & Services</a></div>
      </div>
    </div>
  </div>
</section>

<!-- Card Stories -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="relative z-10">
      <div>
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">Real Stories</h3>
        </div>
        <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
          <div class="w-full lg:w-2/3">
            <div class="prose xl:prose-lg mr-auto text-left">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
            </div>
          </div>
          <div class="w-full lg:w-1/3 text-right">
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-8">
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=22" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          <div>Lorem ipsum dolor sit amet, ipsum labitur lucilius mel id, ad has appareat.</div>
          <a href="#" class="text-brand-sea underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=23" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          <div>Lorem ipsum dolor sit amet, ipsum labitur lucilius mel id, ad has appareat.</div>
          <a href="#" class="text-brand-sea underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=25" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          <div>Lorem ipsum dolor sit amet, ipsum labitur lucilius mel id, ad has appareat.</div>
          <a href="#" class="text-brand-sea underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Card News -->
<section class="bg-brand-light-gray">
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="relative z-10">
      <div>
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">News & resources</h3>
        </div>
        <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
          <div class="w-full lg:w-2/3">
            <div class="prose xl:prose-lg mr-auto text-left">
              <p>When you register with CoAct, our dedicated local team invests in you from the start. </p>
            </div>
          </div>
          <div class="w-full lg:w-1/3 text-right">
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-8">
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=26" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-sea">What does the 2023 Budget mean for job seekers?</h4>
            <div class="text-sm">Everyone on Jobseeker The JobSeeker rate will undergo a permanent rise for all beneficiaries, by $40 per fortnight. </div>
            <a href="#" class="text-brand-sea text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=27" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-sea">Your guide to Workforce Australia</h4>
            <div class="text-sm">On Monday 4 July, the employment support jobactive customers receive will change. Find out how the new Workforce Australia service affects you.</div>
            <a href="#" class="text-brand-sea text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=28" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-sea">How much can I earn on the DSP?</h4>
            <div class="text-sm">Wondering if you’ll lose your Disability Support Pension (DSP) if you start working? Want to find a job but not sure how many hours you can work and still receive the full DSP.?</div>
            <a href="#" class="text-brand-sea text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Card TV -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="relative z-10">
      <div>
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">CoAct TV</h3>
        </div>
        <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
          <div class="w-full lg:w-2/3">
            <div class="prose xl:prose-lg mr-auto text-left">
              <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
            </div>
          </div>
          <div class="w-full lg:w-1/3 text-right">
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-orange text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-8">
        <div class="col-span-2">
          <div class="relative block">
            <a class="block relative aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
              <img src="https://picsum.photos/800/400?random=22" alt="" class="object-cover">
              <?php echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-28 h-28 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2')); ?>
            </a>
            <h4 class="text-2xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          </div>
        </div>
        <div class="col-span-1 grid grid-cols-1 gap-4">
          <div class="relative block">
            <a class="block aspect-w-16 aspect-h-9 overflow-hidden rounded-2xl">
              <img src="https://picsum.photos/400/300?random=23" alt="" class="object-cover">
              <?php echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-16 h-16 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2')); ?>
            </a>
            <h4 class="text-base font-semibold mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          </div>
          <div class="relative block">
            <a class="block aspect-w-16 aspect-h-9 overflow-hidden rounded-2xl">
              <img src="https://picsum.photos/400/300?random=25" alt="" class="object-cover">
              <?php echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-16 h-16 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2')); ?>
            </a>
            <h4 class="text-base font-semibold mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Image Right + Text -->
<section class="bg-brand-purple">
  <div class="relative container max-w-screen-xxl mx-auto py-12">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24 items-center">
      <div class="w-full order-2 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-1/2 relative">
        <div class="mb-8 mx-auto xl:mb-0 max-w-full"><img src="<?php echo coact_asset('images/content/illustration-2.png') ?>" class="" alt=""></div>
      </div>
      <div class="w-full order-1 lg:w-2/3 xl:w-1/2 pt-10">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-8 text-left text-[48px] leading-tight font-bold text-white">Subscribe to the my JobCoach newsletter:</h3>
        </div>
        <div class="my-6">
          <div class="grid grid-cols-2 gap-3">
            <input type="text" placeholder="First name*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
            <input type="text" placeholder="Last name*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
            <input type="text" placeholder="Email*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
            <input type="text" placeholder="Postcode*" class="bg-black/50 w-full rounded-full border-none py-3 px-6 placeholder:text-white/50">
          </div>
        </div>
        <div class="prose max-w-none leading-snug mr-auto text-left mb-6 xl:mb-6 text-white">
          <p>We can help you navigate the world of work with the latest job search tips, news and updates direct to your inbox each week.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>