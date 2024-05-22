 @extends('pages.frontend.parent')

 @section('content')
     <section class="flex flex-col py-16">
         <div class="container mx-auto mb-4">
             <div class="flex justify-center text-center mb-4">
                 <h3 class="text-2xl capitalize font-semibold">
                     Just Arrived <br class="" />this summer for you
                 </h3>
             </div>
         </div>
         <div class="overflow-x-hidden px-4" id="carousel">
             <div class="container mx-auto"></div>
             <!-- <div class="overflow-hidden z-10"> -->
             <div class="flex -mx-4 flex-row relative">

                 @foreach ($product as $item)
                     <!-- START: JUST ARRIVED ROW 1 -->
                     <div class="px-4 relative card group">
                         <div class="rounded-xl overflow-hidden card-shadow relative" style="width: 287px; height: 386px">
                             <div
                                 class="absolute opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center w-full h-full bg-black bg-opacity-0 hover:bg-opacity-50">
                                 <div class="bg-white text-black rounded-full w-16 h-16 flex items-center justify-center">
                                     <svg class="fill-current" width="43" height="24" viewBox="0 0 43 24"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <!-- SVG Icon -->
                                     </svg>
                                 </div>
                             </div>
                             @if ($item->product_galleries->isNotEmpty())
                                 <img src="{{ asset('storage/product/gallery/' . $item->product_galleries->first()->image) }}"
                                     alt=""
                                     class="w-full h-full object-cover object-center transition duration-300 transform group-hover:scale- d-flex" />
                             @else
                                 <img src="{{ asset('placeholder-image.jpg') }}" alt="Placeholder Image"
                                     class="w-full h-full object-cover object-center transition duration-300 transform group-hover:scale-105" />
                             @endif
                         </div>
                         <h5 class="text-lg font-semibold mt-4">{{ $item->name }}</h5>
                         <span class="">Rp. {{ number_format($item->price) }}</span>
                         <a href="{{ route('detail.product', $item->slug) }}" class="stretched-link">
                             <!-- fake children -->
                         </a>
                     </div>
                     <!-- END: JUST ARRIVED ROW 1 -->
                 @endforeach





             </div>
             <!-- </div> -->
         </div>
     </section>
 @endsection
