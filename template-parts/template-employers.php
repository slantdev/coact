<?php

/**
 * Template Name: Employers
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
        <div class="absolute top-0 left-0 w-[1300px] h-[1300px] rounded-full bg-brand-purple bg-opacity-80 -translate-y-1/4 -translate-x-1/4"></div>
        <div class="absolute inset-0 flex items-center p-12">
          <div class="w-1/2 font-montserrat">
            <div class="mb-16 flex gap-x-3 items-center text-white"><span>Home</span><svg xmlns="http://www.w3.org/2000/svg" width="9.245" height="15.38" viewBox="0 0 9.245 15.38">
                <path id="Arrow_2" data-name="Arrow 2" d="M1846.773,982.341a.677.677,0,0,1,.469.188l6.812,6.505a.687.687,0,0,1,0,.993l-6.812,6.505a.679.679,0,0,1-.963-.025.688.688,0,0,1,.024-.968l6.292-6.009-6.292-6.009a.688.688,0,0,1-.024-.968A.678.678,0,0,1,1846.773,982.341Z" transform="translate(-1845.52 -981.841)" fill="#f26b49" stroke="#f26b49" stroke-width="1" />
              </svg><span class="font-bold">Employer</span></div>
            <h2 class="text-5xl text-white font-bold mb-4">I’m an Employer</h2>
            <div class="text-xl text-white font-medium mt-4">
              If you are a young person aged between 12-25 and you’ve been out of work for a while, recently lost your job, or you have an injury, illness or disability, this section is designed for you.
            </div>
            <div class="flex gap-x-4 mt-8">
              <a href="#" class="px-6 py-3 rounded-full border border-solid font-semibold font-poppins text-xl bg-white border-transparent text-black">Need some extra support</a>
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
          <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold text-brand-purple">We understand that the ability to attract and retain employee talent is vital for business success.</h3>
        </div>
        <div class="prose prose-xl max-w-none font-medium mb-6">
          CoAct Service Partners have a pool of over 30,000 willing candidates located all across Australia.
        </div>
        <div class="prose max-w-none xl:prose-lg mr-auto text-left mb-6 xl:mb-8">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
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
          <h3 class="mb-4 xl:mb-8 text-left text-4xl font-bold">How we can help you</h3>
        </div>
      </div>
      <div class="flex flex-wrap lg:flex-nowrap lg:gap-x-24 pb-12">
        <div class="w-full lg:w-3/5">
          <div class="prose xl:prose-lg mr-auto text-left">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
          </div>
        </div>
        <div class="w-full lg:w-1/3 text-right">
          <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-purple text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">Talk to us</a>
        </div>
      </div>
    </div>
    <div class="case-study-grid relative">
      <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-6 lg:gap-8 2xl:gap-10">
        <a href="#" class="card-hover card-brand-purple h-full rounded-xl bg-slate-100 relative overflow-hidden cursor-pointer shadow-md">
          <div class="aspect-w-1 aspect-h-1"><img class="card-image object-center object-cover" src="https://picsum.photos/400/300?random=16"></div>
          <div class="card-text">
            <h3 class="card-title">Workforce Australia is the new system to help you find a job</h3>
            <div class="card-excerpt">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ullamcorper eu, nunc adipiscing risus sit tristique eget lacinia. Lacus, velit eget molestie quis tellus neque, vel, consectetur.
            </div>
            <button type="button" class="bg-white p-4 absolute right-6 bottom-6 rounded-full w-8 h-8 xl:w-12 xl:h-12">
              <span class="block w-4 h-1 bg-brand-purple absolute top-1/2 -translate-y-1/2"></span>
              <span class="block w-1 h-4 bg-brand-purple absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2"></span>
            </button>
          </div>
        </a>
        <a href="#" class="card-hover card-brand-purple h-full rounded-xl bg-slate-100 relative overflow-hidden cursor-pointer shadow-md">
          <div class="aspect-w-1 aspect-h-1"><img class="card-image object-center object-cover" src="https://picsum.photos/400/300?random=17"></div>
          <div class="card-text">
            <h3 class="card-title">What is Workforce Australia?</h3>
            <div class="card-excerpt">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ullamcorper eu, nunc adipiscing risus sit tristique eget lacinia. Lacus, velit eget molestie quis tellus neque, vel, consectetur.
            </div>
            <button type="button" class="bg-white p-4 absolute right-6 bottom-6 rounded-full w-8 h-8 xl:w-12 xl:h-12">
              <span class="block w-4 h-1 bg-brand-purple absolute top-1/2 -translate-y-1/2"></span>
              <span class="block w-1 h-4 bg-brand-purple absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2"></span>
            </button>
          </div>
        </a>
        <a href="#" class="card-hover card-brand-purple h-full rounded-xl bg-slate-100 relative overflow-hidden cursor-pointer shadow-md">
          <div class="aspect-w-1 aspect-h-1"><img class="card-image object-center object-cover" src="https://picsum.photos/400/300?random=18"></div>
          <div class="card-text">
            <h3 class="card-title">Why choose CoAct Employment Services?</h3>
            <div class="card-excerpt">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ullamcorper eu, nunc adipiscing risus sit tristique eget lacinia. Lacus, velit eget molestie quis tellus neque, vel, consectetur.
            </div>
            <button type="button" class="bg-white p-4 absolute right-6 bottom-6 rounded-full w-8 h-8 xl:w-12 xl:h-12">
              <span class="block w-4 h-1 bg-brand-purple absolute top-1/2 -translate-y-1/2"></span>
              <span class="block w-1 h-4 bg-brand-purple absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2"></span>
            </button>
          </div>
        </a>
      </div>
      <div class="blocker absolute inset-0 bg-white bg-opacity-40" style="display: none;"></div>
    </div>
  </div>
</section>

<!-- Card Stories -->
<section>
  <div class="relative container max-w-screen-xxl mx-auto pt-0 lg:pt-20 pb-12 lg:pb-20 xl:pb-36">
    <div class="relative z-10">
      <div class="text-center max-w-prose mx-auto mb-14">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-4xl font-bold">Working with us</h3>
        </div>
        <div class="prose prose-xl max-w-none font-medium mb-6">
          When you visit your local CoAct office, you will be warmly greeted by a dedicated and friendly employment consultant who will assist you throughout your job search journey.
        </div>
      </div>
      <div class="grid grid-cols-2 gap-8">
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=22" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Experience the power of many</h4>
          <div>Employment services are government-funded services designed to help you build a strong workforce. As a leading national partnership of for-purpose Service Partners, CoAct specialises in finding, recruiting, training, mentoring and supporting Australians who are looking to find and keep work.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=23" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">What are employment services?</h4>
          <div>Employment services are government-funded services designed to help you build a strong workforce. As a leading national partnership of for-purpose Service Partners, CoAct specialises in finding, recruiting, training, mentoring and supporting Australians who are looking to find and keep work.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
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
          <?php echo coact_svg(array('svg' => 'shape-2', 'group' => 'shapes', 'size' => false, 'class' => 'text-brand-purple w-[660px] h-auto')); ?>
        </div>
        <div class="mb-8 mx-auto xl:mb-12 max-w-full aspect-w-1 aspect-h-1 rounded-full overflow-hidden"><img width="989" height="659" src="https://picsum.photos/400/300?random=15" class="rounded-full mx-auto h-full w-full object-center object-cover" alt=""></div>
      </div>
      <div class="w-full order-2 lg:w-2/3 xl:w-3/5 pt-10">
        <div class="not-prose">
          <h3 class="mb-8 xl:mb-12 text-left text-4xl font-bold">Working with us</h3>
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

<!-- Text Center -->
<section class="bg-brand-light-gray relative">
  <div class="max-w-screen-lg text-center pt-20 pb-20 mx-auto relative z-[1]">
    <div class="text-center max-w-prose mx-auto mb-14">
      <div class="not-prose">
        <h3 class="mb-8 xl:mb-12 text-4xl font-bold">What job seekers say about us</h3>
      </div>
    </div>
    <h3 class="text-brand-purple text-3xl font-bold">Going into CoAct I wasn’t sure what to expect but with continued support I’ve found myself setting and achieving goals while also meeting my requirements. I think what sets CoAct apart from regular job providers is the continued engagement, encouragement and empathy. They didn’t just do it for me; they helped me to help myself. </h3>
    <div class="mt-6 text-lg font-bold">Larissa, Job Seeker</div>
  </div>
</section>

<!-- Icon Numbers -->
<section class="bg-brand-light-gray relative">
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
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-purple text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
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
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=23" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          <div>Lorem ipsum dolor sit amet, ipsum labitur lucilius mel id, ad has appareat.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
        </div>
        <div class="relative block">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-2xl">
            <img src="https://picsum.photos/400/300?random=25" alt="" class="object-cover">
          </a>
          <h4 class="text-xl font-semibold my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor</h4>
          <div>Lorem ipsum dolor sit amet, ipsum labitur lucilius mel id, ad has appareat.</div>
          <a href="#" class="text-brand-purple underline font-medium inline-block mt-4">LEARN MORE</a>
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
            <a class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-xl lg:px-10 lg:py-4 bg-brand-purple text-white border border-transparent shadow-md hover:shadow-lg transition-all duration-200">View all</a>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-8">
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=26" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-purple">What does the 2023 Budget mean for job seekers?</h4>
            <div class="text-sm">Everyone on Jobseeker The JobSeeker rate will undergo a permanent rise for all beneficiaries, by $40 per fortnight. </div>
            <a href="#" class="text-brand-purple text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=27" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-purple">Your guide to Workforce Australia</h4>
            <div class="text-sm">On Monday 4 July, the employment support jobactive customers receive will change. Find out how the new Workforce Australia service affects you.</div>
            <a href="#" class="text-brand-purple text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
        <div class="relative block rounded-2xl overflow-hidden shadow-xl">
          <a class="block aspect-w-16 aspect-h-10 overflow-hidden rounded-t-2xl">
            <img src="https://picsum.photos/400/300?random=28" alt="" class="object-cover">
          </a>
          <div class="p-8">
            <h4 class="text-xl font-semibold mb-4 text-brand-purple">How much can I earn on the DSP?</h4>
            <div class="text-sm">Wondering if you’ll lose your Disability Support Pension (DSP) if you start working? Want to find a job but not sure how many hours you can work and still receive the full DSP.?</div>
            <a href="#" class="text-brand-purple text-sm underline font-medium inline-block mt-8">LEARN MORE</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Image Left + Text -->
<section class="bg-brand-purple">
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
        <div class="mb-6 xl:mb-0 mt-6 xl:mt-8 text-left"><a href="#" class="inline-block rounded-full font-poppins font-semibold px-6 py-3 text-sm lg:text-lg lg:px-10 lg:py-3 bg-white text-brand-purple border border-transparent shadow-md hover:shadow-lg transition-all duration-200">Find Support & Services</a></div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>