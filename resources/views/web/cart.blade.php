@extends('layout.web.main-layout')








@section('content')


 <section class="px-4 lg:pb-12 pb-6 lg:pt-6 pt-4 bg-gray-50 ">
      <div class="container mx-auto">
        <!-- Progress Bar and Banner -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
          <div class="flex items-center mb-4">
            <div class="flex-1 bg-gray-200 rounded-full h-4 relative">
              <div class="bg-black h-4 rounded-full w-1/5"></div>
            </div>
          </div>
          <p class="text-sm text-gray-600">
            Spend $400 more and get free shipping!
          </p>
        </div>

        <div class="flex flex-col lgg:flex-row gap-8">
          <!-- Cart Items - Now using a table -->
          <div class="flex-1 bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
              <table class="w-full text-sm text-left">
                <thead
                  class="text-gray-700 uppercase bg-gray-50 border-b border-gray-200"
                >
                  <tr>
                    <th class="px-6 py-4">Product</th>
                    <th class="px-6 py-4 text-center">Price</th>
                    <th class="px-6 py-4 text-center">Quantity</th>
                    <th class="px-6 py-4 text-center">Subtotal</th>
                    <th class="px-6 py-4 text-center"></th>
                    <!-- Remove -->
                  </tr>
                </thead>
                <tbody>
                  <!-- Cart Item Row -->
                  <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-6">
                      <div class="flex items-center gap-4">
                        <div
                          class="w-24 h-32 bg-gray-200 border-2 border-dashed rounded-lg flex-shrink-0 flex items-center justify-center text-gray-400 text-xs overflow-hidden"
                        >
                          <img
                            class="object-cover object-top object-center w-full h-full"
                            src="./assets/images/Home-image/pic-12.avif"
                            alt=""
                          />
                        </div>
                        <div>
                          <h3 class="font-medium text-gray-900">
                            Slouch Waist Crinkled Dress
                          </h3>
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-6 text-center">$100.00</td>

                    <td class="px-6 py-6 text-center">
                      <div
                        class="flex items-center justify-center border border-gray-300 rounded-md inline-flex"
                      >
                        <button class="px-3 py-1 hover:bg-gray-100">-</button>
                        <input
                          type="text"
                          value="1"
                          class="w-12 text-center border-x border-gray-300 py-1"
                        />
                        <button class="px-3 py-1 hover:bg-gray-100">+</button>
                      </div>
                    </td>

                    <td class="px-6 py-6 text-center font-medium">$100.00</td>

                    <td class="px-6 py-6 text-center">
                      <button class="text-gray-400 hover:text-gray-600">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-5 w-5"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                          />
                        </svg>
                      </button>
                    </td>
                  </tr>

                  <!-- Add more <tr> rows here for additional items -->
                </tbody>
              </table>
            </div>

            <!-- Coupon Section -->
            <div class="mt-3 flex flex-wrap gap-4 px-6 py-6">
              <input
                type="text"
                placeholder="Coupon code"
                class="flex-1 w-full smx:min-w-[300px] px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black"
              />
              <div
                class="flex gap-4 smx:w-fit w-full smx:flex-row flex-col lgg:justify-start justify-end"
              >
                <button
                  class="px-6 py-3 smx:w-fit w-full bg-black text-white lgg:text-[1rem] text-[0.875rem] rounded-md hover:bg-gray-800"
                >
                  Apply coupon
                </button>
                <button
                  class="px-6 py-3 smx:w-fit w-full border border-gray-300 lgg:text-[1rem] text-[0.875rem] rounded-md hover:bg-gray-100"
                >
                  Continue shopping
                </button>
              </div>
            </div>
          </div>

          <!-- Cart Totals Sidebar -->
          <div class="lg:w-80">
            <div class="bg-white rounded-lg shadow-sm p-6">
              <h2 class="text-lg font-medium text-gray-900 mb-6">
                Cart Totals
              </h2>

              <div class="space-y-4">
                <div class="flex justify-between text-gray-700">
                  <span>Subtotal</span>
                  <span>$100.00</span>
                </div>

                <div class="flex justify-between text-gray-700">
                  <span>Shipping</span>
                  <div class="text-right">
                    <span class="block text-sm">Shipping to India.</span>
                    <a href="#" class="text-sm text-blue-600 hover:underline"
                      >Change address</a
                    >
                  </div>
                </div>

                <div class="border-t border-gray-200 pt-4">
                  <div
                    class="flex justify-between text-lg font-medium text-gray-900"
                  >
                    <span>Total</span>
                    <span>$100.00</span>
                  </div>
                </div>

                <button
                  class="px-6 py-3 w-full bg-black text-white lgg:text-[1rem] text-[0.875rem] rounded-md hover:bg-gray-800"
                >
                  Proceed to checkout
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


@endsection