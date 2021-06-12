<template>
  <div>
    <div class="flex-1 flex flex-col overflow-hidden">
      <div class="flex h-full">
        <nav class="flex w-72 h-screen bg-indigo-100">
          <div class="w-72" v-if="$fetchState.pending">
            <div
              class="py-4 px-2 space-y-4 w-full mx-auto"
              v-for="(item, index) in 20"
              :key="index"
            >
              <div class="animate-pulse flex space-x-4">
                <div class="space-y-2">
                  <div class="rounded-md bg-indigo-300 h-8 w-8"></div>
                </div>
                <div class="flex-1 space-y-1 py-1">
                  <div class="h-1 bg-indigo-300 rounded w-3/6"></div>
                  <div class="h-2 bg-indigo-300 rounded w-1/4"></div>
                </div>
              </div>
            </div>
          </div>
          <div
            v-if="!$fetchState.pending"
            class="w-full flex mx-auto   flex-col"
          >
            <header class="p-2 bg-gray-300 text-gray-800 text-sm font-bold">
              Spaces
            </header>
            <div
              class="space-y-0.5 p-2 block overflow-y-auto overflow-x-hidden flex-grow scrollbar-thin scrollbar-thumb-indigo-500 scrollbar-track-indigo-300 scrollbar-track-rounded-m"
            >
              <nuxt-link
                v-for="(space, index) in spaces"
                :key="index"
                :to="{
                  name: 'spaces.show',
                  params: {
                    uid: space.uid,
                    room: space.home.uid
                  }
                }"
                class="cursor-pointer space-x-2 flex items-center hover:bg-indigo-200 focus:bg-indigo-200 px-2 py-2 rounded-md w-68"
              >
                <span
                  class="p-2 hover:animate-pulse bg-indigo-400 text-white w-8 h-8 rounded-md"
                  ><outline-user-icon class="h-4 w-4"></outline-user-icon
                ></span>
                <div class="truncate">
                  {{ space.name }}
                </div>
              </nuxt-link>
            </div>
          </div>
        </nav>
        <main class="flex flex-col w-full h-screen bg-gray-50"></main>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: "space",
  head() {
    return {
      title: "Spaces"
    };
  },
  data() {
    return {
      spaces: [],
      messages: []
    };
  },
  async fetch() {
    this.spaces = await this.$axios.$get("/spaces");
  },
  fetchOnServer: false
};
</script>
