<?php

/**
 * Template Name: Job Seeker
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
        <img class="object-cover" src="<?php echo coact_asset('images/banner/banner-2.jpg') ?>" alt="">
        <div class="absolute top-0 left-0 w-[1300px] h-[1300px] rounded-full bg-brand-sea bg-opacity-80 -translate-y-1/4 -translate-x-1/4"></div>
        <div class="absolute inset-0 flex items-center p-12">
          <div class="w-1/2 font-montserrat">
            <div class="mb-16 flex gap-x-3 items-center text-black"><span>Home</span><svg xmlns="http://www.w3.org/2000/svg" width="9.245" height="15.38" viewBox="0 0 9.245 15.38">
                <path id="Arrow_2" data-name="Arrow 2" d="M1846.773,982.341a.677.677,0,0,1,.469.188l6.812,6.505a.687.687,0,0,1,0,.993l-6.812,6.505a.679.679,0,0,1-.963-.025.688.688,0,0,1,.024-.968l6.292-6.009-6.292-6.009a.688.688,0,0,1-.024-.968A.678.678,0,0,1,1846.773,982.341Z" transform="translate(-1845.52 -981.841)" fill="#f26b49" stroke="#f26b49" stroke-width="1" />
              </svg><span class="font-bold">Job Seeker</span></div>
            <h2 class="text-5xl text-black font-bold mb-4">I’m a Job Seeker</h2>
            <div class="text-xl text-black font-medium mt-4">
              If you are a young person aged between 12-25 and you’ve been out of work for a while, recently lost your job, or you have an injury, illness or disability, this section is designed for you.
            </div>
            <div class="flex gap-x-4 mt-8">
              <a href="#" class="px-6 py-3 rounded-full border border-solid font-semibold font-poppins text-xl bg-white border-transparent text-brand-sea">Need some extra support</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Image Left + Text -->
<section class="bg-white relative mt-10">
  <div class="relative max-w-screen-3xl h-1">
    <div class="absolute top-0 right-0">
      <?php echo coact_svg(array('svg' => 'shape-1', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-orange w-[500px] h-auto')); ?>
    </div>
  </div>
  <div class="container max-w-screen-md relative z-10 pt-24">
    <select name="" id="" class="w-full border-zinc-300 rounded-full py-4 pl-8">
      <option value="">On this page</option>
      <option value="">Option 1</option>
      <option value="">Option 2</option>
    </select>
  </div>
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
        <div class="mb-8 mx-auto xl:mb-12 max-w-full rounded-xl aspect-w-1 aspect-h-1 overflow-hidden"><img width="989" height="659" src="https://picsum.photos/400/400?random=15" class="rounded-xl mx-auto h-full w-full object-center object-cover" alt=""></div>
        <div class="flex flex-col gap-6">
          <div class="flex gap-x-6">
            <div class="flex-none"><?php echo coact_icon(array('icon' => 'call', 'group' => 'content', 'size' => '36', 'class' => 'text-brand-purple')); ?></div>
            <div class="text-2xl font-medium"><a href="#" class="text-brand-purple">Contact us</a></div>
          </div>
          <div class="flex gap-x-6">
            <div class="flex-none"><?php echo coact_icon(array('icon' => 'users', 'group' => 'content', 'size' => '36', 'class' => 'text-brand-purple')); ?></div>
            <div class="text-2xl font-medium"><a href="#" class="text-brand-purple">Register for DES</a></div>
          </div>
          <div class="flex gap-x-6">
            <div class="flex-none"><?php echo coact_icon(array('icon' => 'bullhorn', 'group' => 'content', 'size' => '36', 'class' => 'text-brand-purple')); ?></div>
            <div class="text-2xl font-medium"><a href="#" class="text-brand-purple">Discover Jobs</a></div>
          </div>
          <div class="flex gap-x-6">
            <div class="flex-none"><?php echo coact_icon(array('icon' => 'education', 'group' => 'content', 'size' => '36', 'class' => 'text-brand-purple')); ?></div>
            <div class="text-2xl font-medium"><a href="#" class="text-brand-purple">Training & Education</a></div>
          </div>
        </div>
      </div>
      <div class="w-full order-2 lg:w-2/3 xl:w-3/5">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold text-brand-sea">There’s a job out there for you, let’s go find it</h3>
        </div>
        <div class="prose prose-xl max-w-none font-medium mb-6">
          Whether you have experienced a prolonged period of unemployment, recently lost your job, or are dealing with an injury, illness, or disability, we are here to assist you in finding employment.
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <p>We understand the challenges of returning to work, regardless of your age, location, culture, or background.</p>
          <p>At CoAct, we take the time to listen to your story, understand your circumstances, and tailor a program specifically for you.</p>
          <p>If you have been referred to CoAct by Centrelink, you have come to the right place. If another organization has referred you to CoAct, rest assured that we can still provide the support you need.</p>
          <p><strong>Our programs offer various types of assistance based on your individual requirements, and they all include the following steps to help you:</strong></p>
          <ol>
            <li>Enhance your job searching skills</li>
            <li>Discover job opportunities in your vicinity</li>
            <li>Craft a compelling resume</li>
            <li>Prepare for job interviews</li>
            <li>Communicate confidently with potential employers</li>
          </ol>
          <p>We have dedicated services for mature job seekers, young job seekers, and those transitioning from school.</p>
          <p>For Indigenous Australians or individuals from culturally diverse communities seeking their next job, we have specialized support available.</p>
          <p><strong>No matter your situation, we are committed to helping you succeed in your job search.</strong></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Video -->
<section class="bg-brand-light-gray relative">
  <div class="relative pt-4 lg:pt-6 xl:pt-24 pb-4 lg:pb-6 xl:pb-24">
    <div class="text-center max-w-prose mx-auto mb-14">
      <div class="not-prose">
        <h3 class="mb-8 xl:mb-12 text-4xl font-bold">How Disability Employment Services can help you find work</h3>
      </div>
      <div class="prose prose-xl max-w-none font-medium mb-6">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ullamcorper eu, nunc adipiscing risus sit tristique eget lacinia. Lacus, velit eget molestie quis tellus neque, vel, consectetur.
      </div>
    </div>
    <div class="container max-w-screen-3xl">
      <div class="block relative aspect-w-16 aspect-h-9 overflow-hidden rounded-2xl">
        <img src="https://picsum.photos/800/400?random=22" alt="" class="object-cover">
        <?php echo coact_icon(array('icon' => 'video', 'group' => 'utilities', 'size' => '128', 'class' => 'absolute w-28 h-28 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2')); ?>
      </div>
    </div>
  </div>
</section>

<!-- Card Hover -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 xl:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div>
      <div class="w-3/5">
        <div class="not-prose">
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">How Disability Employment Services can help you find work</h3>
        </div>
      </div>
      <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
        <div class="w-full lg:w-3/5">
          <div class="prose xl:prose-lg mr-auto text-left">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
          </div>
        </div>
        <div class="w-full lg:w-1/3 text-right">
          <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-sea text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">Talk to us</a>
        </div>
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

<!-- Image Left + Text -->
<section class="bg-[#E2E2E2] relative mt-10">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
        <div class="mb-8 mx-auto xl:mb-12 max-w-full rounded-xl aspect-w-1 aspect-h-1 overflow-hidden"><img width="989" height="659" src="https://picsum.photos/400/400?random=15" class="rounded-xl mx-auto h-full w-full object-center object-cover" alt=""></div>
      </div>
      <div class="w-full order-2 lg:w-2/3 xl:w-3/5">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold text-black">You could be eligible for Disability Employment Services if:</h3>
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <ul>
            <li>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna erat.</li>
            <li>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna erat.</li>
            <li>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna erat.</li>
          </ul>
          <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 mt-8 text-sm lg:text-xl lg:px-10 lg:py-4 bg-white text-brand-sea border border-transparent shadow-md hover:shadow-lg transition-all duration-200 no-underline">Talk to us</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Text Center -->
<section class="bg-brand-light-gray relative">
  <div class="max-w-screen-lg text-center pt-[180px] pb-20 mx-auto relative z-[1]">
    <h3 class="text-brand-purple text-3xl font-bold">Going into CoAct I wasn’t sure what to expect but with continued support I’ve found myself setting and achieving goals while also meeting my requirements. I think what sets CoAct apart from regular job providers is the continued engagement, encouragement and empathy. They didn’t just do it for me; they helped me to help myself. </h3>
    <div class="mt-6 text-lg font-bold">Larissa, Job Seeker</div>
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

<!-- Image Left + Text -->
<section class="bg-white relative mt-10">
  <div class="relative container max-w-screen-xxl mx-auto pt-12 lg:pt-20 xl:pt-36 pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-1 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
        <div class="mb-8 mx-auto xl:mb-12 max-w-full rounded-xl aspect-w-1 aspect-h-1 overflow-hidden"><img width="989" height="659" src="https://picsum.photos/400/400?random=15" class="rounded-xl mx-auto h-full w-full object-center object-cover" alt=""></div>
      </div>
      <div class="w-full order-2 lg:w-2/3 xl:w-3/5">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold text-black">Support to build an inclusive and diverse workforce</h3>
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <p>CoAct is a national leader in quality employment services that connect employers to job-ready candidates Australia-wide. We specialise in placing people with disability, Aboriginal and Torres Strait Islander peoples, the long-term unemployed, parents, mature-age workers, youth, people from diverse cultural and linguistic backgrounds and other disadvantaged groups.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Image Left + Text -->
<section class="bg-white relative mt-10">
  <div class="relative container max-w-screen-xxl mx-auto pb-12 lg:pb-20 xl:pb-36">
    <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-16 xl:gap-x-16 3xl:gap-x-24">
      <div class="w-full order-2 max-w-[360px] lg:max-w-none lg:w-1/3 xl:w-2/5 relative">
        <div class="mb-8 mx-auto xl:mb-12 max-w-full rounded-xl aspect-w-1 aspect-h-1 overflow-hidden"><img width="989" height="659" src="https://picsum.photos/400/400?random=15" class="rounded-xl mx-auto h-full w-full object-center object-cover" alt=""></div>
      </div>
      <div class="w-full order-1 lg:w-2/3 xl:w-3/5">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold text-black">Local and national solutions to benefit employers and the community</h3>
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <p>Our unique partnership model delivers the best of local and national solutions to ensure consistent service delivery and a coordinated employer engagement strategy that meets your recruitment needs.</p>
          <p>Working with you locally: CoAct Service Partners are employment experts who know your community, the local job market and take time to understand your specific needs.</p>
          <p> Working at a national level: CoAct works to improve services, share knowledge, create new innovations and work alongside our Service Partners to ensure your business always benefits from our great service.</p>
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