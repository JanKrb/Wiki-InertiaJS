<template>
  <div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9">
      <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Notification -->
        <div class="col-span-12 mt-6 -mb-6 intro-y">
          <div
            class="alert alert-dismissible show box bg-theme-3 text-white flex items-center mb-6"
            role="alert"
          >
            <span>
              This is our ITA wiki
            </span>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            >
              <XIcon class="w-4 h-4" />
            </button>
          </div>
        </div>
        <!-- BEGIN: Notification -->
        <!-- BEGIN: Blog Layout -->
        <div
          v-for="(faker, fakerKey) in $_.take($f(), 6)"
          :key="fakerKey"
          class="intro-y blog col-span-12 md:col-span-6 box"
        >
          <div class="blog__preview image-fit">
            <img
              alt="Icewall Tailwind HTML Admin Template"
              class="rounded-t-md"
              :src="require(`@/assets/images/${faker.images[0]}`)"
            />
            <div class="absolute w-full flex items-center px-5 pt-6 z-10">
              <div class="w-10 h-10 flex-none image-fit">
                <img
                  alt="Icewall Tailwind HTML Admin Template"
                  class="rounded-full"
                  :src="require(`@/assets/images/${faker.photos[0]}`)"
                />
              </div>
              <div class="ml-3 text-white mr-auto">
                <a href="" class="font-medium">{{ faker.users[0].name }}</a>
                <div class="text-xs mt-0.5">{{ faker.formattedTimes[0] }}</div>
              </div>
              <div class="dropdown ml-3">
                <a
                  href="javascript:;"
                  class="blog__action dropdown-toggle w-8 h-8 flex items-center justify-center rounded-full"
                  aria-expanded="false"
                >
                  <MoreVerticalIcon class="w-4 h-4 text-white" />
                </a>
                <div class="dropdown-menu w-40">
                  <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                      <Edit2Icon class="w-4 h-4 mr-2" /> Edit
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
              <a href="" class="block font-medium text-xl mt-3">{{
                  faker.news[0].title
                }}</a>
            </div>
          </div>
          <div class="p-5 text-gray-700 dark:text-gray-600">
            {{ faker.news[0].shortContent }}
          </div>
          <div class="flex items-center px-5 py-3 border-t border-gray-200 dark:border-dark-5 text-gray-600">
            <div class="mr-2">
              Comments:
              <span class="font-medium">{{ faker.totals[0] }}</span>
            </div>
            <div class="mr-2">
              Posts: <span class="font-medium">{{ faker.totals[1] }}k</span>
            </div>
            <div class="mr-2">
              Likes: <span class="font-medium">{{ faker.totals[2] }}k</span>
            </div>
            <Tippy
              tag="a"
              href=""
              class="intro-x w-8 h-8 flex items-center justify-center rounded-full border border-gray-400 dark:border-dark-5 dark:bg-dark-5 dark:text-gray-300 text-gray-600 ml-auto"
              content="Bookmark"
            >
              <BookmarkIcon class="w-3 h-3" />
            </Tippy>
            <Tippy
              tag="a"
              href=""
              class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-theme-14 dark:bg-dark-5 dark:text-gray-300 text-theme-10 ml-2"
              content="Share"
            >
              <Share2Icon class="w-3 h-3" />
            </Tippy>
          </div>
        </div>
        <!-- END: Blog Layout -->
      </div>
    </div>
    <div class="col-span-12 xxl:col-span-3">
      <div class="xxl:border-l border-theme-5 -mb-10 pb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
          <!-- BEGIN: Important Notes -->
          <div class="col-span-12 md:col-span-6 xl:col-span-12 mt-3 xxl:mt-8">
            <div class="intro-x flex items-center h-10">
              <h2 class="text-lg font-medium truncate mr-auto">
                Important Notes
              </h2>
              <button
                data-carousel="important-notes"
                data-target="prev"
                class="tiny-slider-navigator btn px-2 border-gray-400 text-gray-700 dark:text-gray-300 mr-2"
                @click="prevImportantNotes"
              >
                <ChevronLeftIcon class="w-4 h-4" />
              </button>
              <button
                data-carousel="important-notes"
                data-target="next"
                class="tiny-slider-navigator btn px-2 border-gray-400 text-gray-700 dark:text-gray-300 mr-2"
                @click="nextImportantNotes"
              >
                <ChevronRightIcon class="w-4 h-4" />
              </button>
            </div>
            <div class="mt-5 intro-x">
              <div class="box zoom-in">
                <TinySlider ref-key="importantNotesRef">
                  <div class="p-5">
                    <div class="text-base font-medium truncate">
                      Lorem Ipsum is simply dummy text
                    </div>
                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                    <div class="text-gray-600 text-justify mt-1">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text ever since the 1500s.
                    </div>
                    <div class="font-medium flex mt-5">
                      <button type="button" class="btn btn-secondary py-1 px-2">
                        View Notes
                      </button>
                      <button
                        type="button"
                        class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto"
                      >
                        Dismiss
                      </button>
                    </div>
                  </div>
                  <div class="p-5">
                    <div class="text-base font-medium truncate">
                      Lorem Ipsum is simply dummy text
                    </div>
                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                    <div class="text-gray-600 text-justify mt-1">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text ever since the 1500s.
                    </div>
                    <div class="font-medium flex mt-5">
                      <button type="button" class="btn btn-secondary py-1 px-2">
                        View Notes
                      </button>
                      <button
                        type="button"
                        class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto"
                      >
                        Dismiss
                      </button>
                    </div>
                  </div>
                  <div class="p-5">
                    <div class="text-base font-medium truncate">
                      Lorem Ipsum is simply dummy text
                    </div>
                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                    <div class="text-gray-600 text-justify mt-1">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text ever since the 1500s.
                    </div>
                    <div class="font-medium flex mt-5">
                      <button type="button" class="btn btn-secondary py-1 px-2">
                        View Notes
                      </button>
                      <button
                        type="button"
                        class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto"
                      >
                        Dismiss
                      </button>
                    </div>
                  </div>
                </TinySlider>
              </div>
            </div>
          </div>
          <!-- END: Important Notes -->
          <!-- BEGIN: General Report -->
          <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 xl:col-start-1 xl:row-start-2 xxl:col-start-auto xxl:row-start-auto mt-3">
            <div class="report-box-2 intro-y mt-12 sm:mt-5">
              <div class="box sm:flex">
                <div class="px-8 py-12 flex flex-col justify-center flex-1">
                  <FileTextIcon class="w-10 h-10 text-theme-12" />
                  <div class="relative text-3xl font-bold mt-12">
                    4 Posts
                  </div>
                  <div class="mt-4 text-gray-600 dark:text-gray-600">
                    These are the Wikiposts in all Categories.
                  </div>
                  <button class="btn btn-outline-secondary relative justify-start rounded-full mt-12">
                    Search wiki
                    <span class="w-8 h-8 absolute flex justify-center items-center bg-theme-1 text-white rounded-full right-0 top-0 bottom-0 my-auto ml-auto mr-0.5">
                    <ArrowRightIcon class="w-4 h-4" />
                  </span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- END: General Report -->
          <!-- BEGIN: Recent Activities -->
          <div
            class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3"
          >
            <div class="intro-x flex items-center h-10">
              <h2 class="text-lg font-medium truncate mr-5">
                Recent Activities
              </h2>
              <a
                href=""
                class="ml-auto text-theme-1 dark:text-theme-10 truncate"
              >Show More</a
              >
            </div>
            <div class="report-timeline mt-5 relative">
              <div class="intro-x relative flex items-center mb-3">
                <div class="report-timeline__image">
                  <div
                    class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"
                  >
                    <img
                      alt="Icewall Tailwind HTML Admin Template"
                      :src="require(`@/assets/images/${$f()[9].photos[0]}`)"
                    />
                  </div>
                </div>
                <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                  <div class="flex items-center">
                    <div class="font-medium">
                      {{ $f()[9].users[0].name }}
                    </div>
                    <div class="text-xs text-gray-500 ml-auto">07:00 PM</div>
                  </div>
                  <div class="text-gray-600 mt-1">Has joined the team</div>
                </div>
              </div>
              <div class="intro-x relative flex items-center mb-3">
                <div class="report-timeline__image">
                  <div
                    class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"
                  >
                    <img
                      alt="Icewall Tailwind HTML Admin Template"
                      :src="require(`@/assets/images/${$f()[8].photos[0]}`)"
                    />
                  </div>
                </div>
                <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                  <div class="flex items-center">
                    <div class="font-medium">
                      {{ $f()[8].users[0].name }}
                    </div>
                    <div class="text-xs text-gray-500 ml-auto">07:00 PM</div>
                  </div>
                  <div class="text-gray-600">
                    <div class="mt-1">Added 3 new photos</div>
                    <div class="flex mt-2">
                      <Tippy
                        tag="div"
                        class="w-8 h-8 image-fit mr-1 zoom-in"
                        :content="$f()[0].products[0].name"
                      >
                        <img
                          alt="Icewall Tailwind HTML Admin Template"
                          class="rounded-md border border-white"
                          :src="require(`@/assets/images/${$f()[8].images[0]}`)"
                        />
                      </Tippy>
                      <Tippy
                        tag="div"
                        class="w-8 h-8 image-fit mr-1 zoom-in"
                        :content="$f()[1].products[0].name"
                      >
                        <img
                          alt="Icewall Tailwind HTML Admin Template"
                          class="rounded-md border border-white"
                          :src="require(`@/assets/images/${$f()[8].images[1]}`)"
                        />
                      </Tippy>
                      <Tippy
                        tag="div"
                        class="w-8 h-8 image-fit mr-1 zoom-in"
                        :content="$f()[2].products[0].name"
                      >
                        <img
                          alt="Icewall Tailwind HTML Admin Template"
                          class="rounded-md border border-white"
                          :src="require(`@/assets/images/${$f()[8].images[2]}`)"
                        />
                      </Tippy>
                    </div>
                  </div>
                </div>
              </div>
              <div class="intro-x text-gray-500 text-xs text-center my-4">
                12 November
              </div>
              <div class="intro-x relative flex items-center mb-3">
                <div class="report-timeline__image">
                  <div
                    class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"
                  >
                    <img
                      alt="Icewall Tailwind HTML Admin Template"
                      :src="require(`@/assets/images/${$f()[7].photos[0]}`)"
                    />
                  </div>
                </div>
                <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                  <div class="flex items-center">
                    <div class="font-medium">
                      {{ $f()[7].users[0].name }}
                    </div>
                    <div class="text-xs text-gray-500 ml-auto">07:00 PM</div>
                  </div>
                  <div class="text-gray-600 mt-1">
                    Has changed
                    <a class="text-theme-1 dark:text-theme-10" href="">{{
                        $f()[7].products[0].name
                      }}</a>
                    price and description
                  </div>
                </div>
              </div>
              <div class="intro-x relative flex items-center mb-3">
                <div class="report-timeline__image">
                  <div
                    class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"
                  >
                    <img
                      alt="Icewall Tailwind HTML Admin Template"
                      :src="require(`@/assets/images/${$f()[6].photos[0]}`)"
                    />
                  </div>
                </div>
                <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                  <div class="flex items-center">
                    <div class="font-medium">
                      {{ $f()[6].users[0].name }}
                    </div>
                    <div class="text-xs text-gray-500 ml-auto">07:00 PM</div>
                  </div>
                  <div class="text-gray-600 mt-1">
                    Has changed
                    <a class="text-theme-1 dark:text-theme-10" href="">{{
                        $f()[6].products[0].name
                      }}</a>
                    description
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END: Recent Activities -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, provide } from 'vue'

export default defineComponent({
  setup() {
    const importantNotesRef = ref()

    provide('bind[importantNotesRef]', el => {
      importantNotesRef.value = el
    })

    const prevImportantNotes = () => {
      const el = importantNotesRef.value
      el.tns.goTo('prev')
    }
    const nextImportantNotes = () => {
      const el = importantNotesRef.value
      el.tns.goTo('next')
    }

    return {
      prevImportantNotes,
      nextImportantNotes
    }
  }
})
</script>
