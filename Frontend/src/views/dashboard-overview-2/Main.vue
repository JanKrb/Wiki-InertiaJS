<template>
  <div class="grid grid-cols-12 gap-5">
    <div class="col-span-12 xxl:col-span-10">
      <div class="grid grid-cols-12 gap-5">
        <!-- BEGIN: Blog Layout -->
        <div
          v-for="(faker, fakerKey) in $_.take($f(), 6)"
          :key="fakerKey"
          class="intro-y blog col-span-12 md:col-span-4 box"
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
                  <MoreVerticalIcon class="w-4 h-4 text-white"/>
                </a>
                <div class="dropdown-menu w-40">
                  <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                      <Edit2Icon class="w-4 h-4 mr-2"/> Edit
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
    <div class="col-span-12 xxl:col-span-2">
      <div class="xxl:border-l border-theme-5 -mb-10 pb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-5">
          <!-- BEGIN: Important Notes -->
          <div
            class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3"
          >
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

          <!-- BEGIN: Transactions -->
          <div
            class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8"
          >
            <div class="intro-x flex items-center h-10">
              <h2 class="text-lg font-medium truncate mr-5">Recent Posts</h2>
            </div>
            <div class="mt-5">
              <div
                v-for="activity in this.recent"
                :key="activity.id"
                class="intro-x"
              >
                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                  <div
                    class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"
                  >
                    <img
                      alt="Icewall Tailwind HTML Admin Template"
                      :src="activity?.user?.profile_picture"
                    />
                  </div>
                  <div class="ml-4 mr-auto">
                    <div class="font-medium">
                      {{ activity?.title }}
                    </div>
                    <div class="text-gray-600 text-xs mt-0.5">
                      {{ activity?.user?.name }}
                    </div>
                  </div>
                </div>
              </div>
              <a
                href=""
                class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600"
              >View More</a
              >
            </div>
          </div>
          <!-- END: Transactions -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, provide } from 'vue'
import axios from 'axios'

export default defineComponent({
  data() {
    return {
      recent: []
    }
  },
  mounted() {
    this.loadRecent()
  },
  methods: {
    loadRecent() {
      axios.get('http://localhost:8000/api/posts/recent')
        .then((res) => {
          this.recent = res.data.data
          console.log(this.recent)
        })
        .catch((err) => {
          console.log(err)
        })
    }
  },
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
