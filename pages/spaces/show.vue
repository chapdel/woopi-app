<template>
  <div>
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- <header class="flex justify-between items-center bg-indigo-300 p-1">
        <div class="flex">Left</div>
        <div class="flex">Right</div>
      </header> -->
      <div class="flex h-full">
        <nav class="flex w-72 h-screen bg-indigo-100">
          <div class="w-full flex mx-auto p-2">
            <ul class="space-y-0.5 block">
              <li
                v-for="(user, index) in space.members"
                :key="index"
                class="cursor-pointer space-x-2 flex hover:bg-indigo-200 focus:bg-indigo-200 px-2 py-0.5 text-sm rounded-md w-64"
              >
                <span
                  class="p-1 ring ring-offset-2 mt-2 ring-green-500 w-6 h-6 rounded-full"
                  ><outline-user-icon class="h-4 w-4"></outline-user-icon
                ></span>
                <div>
                  <span class="space-x-2 flex">
                    <span>{{ user.name }}</span>
                    <outline-star-icon
                      v-if="user.role == 'superadmin' || user.role == 'admin'"
                      class="text-yellow-500 h-3 w-3 mt-1"
                    ></outline-star-icon>
                  </span>
                  <small class="block text-small text-italic">{{
                    user.bio
                  }}</small>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <main class="flex flex-col w-full h-screen bg-indigo-50">
          <div class="flex flex-col h-screen">
            <div
              class="flex flex-col flex-col-reverse overflow-y-auto discussion-content mb-2 py-2"
            >
              <div
                class="w-full bg-indigo-500 hover:bg-indigo-300 p-2"
                v-for="(message, index) in 3"
                :key="index"
              >
                Lorem ipsum dolor
              </div>
            </div>
            <div class="flex flex-row  items-center  bottom-0 my-2 w-full">
              <div
                class="ml-2 flex flex-row border-gray items-center w-full border rounded-md h-12 px-2"
              >
                <button
                  class="focus:outline-none flex items-center justify-center h-10 w-10 hover:text-red-600 text-red-400 ml-1"
                >
                  <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"
                    ></path>
                  </svg>
                </button>
                <div class="w-full">
                  <input
                    type="text"
                    id="message"
                    class="border rounded-md border-transparent w-full focus:outline-none text-sm h-10 flex items-center"
                    placeholder="Type your message...."
                  />
                </div>
                <div class="flex flex-row">
                  <button
                    class="focus:outline-none flex items-center justify-center h-10 w-8 hover:text-blue-600  text-blue-400"
                  >
                    <svg
                      class="w-5 h-5 "
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                      ></path>
                    </svg>
                  </button>
                  <button
                    id="capture"
                    class="focus:outline-none flex items-center justify-center h-10 w-8 hover:text-green-600 text-green-400 ml-1 mr-2"
                  >
                    <svg
                      class="w-5 h-5"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
              <div class="pl-2">
                <button
                  id="self"
                  class="flex items-center justify-center h-10 w-10 mr-2 rounded-full bg-gray-200 hover:bg-gray-300 text-indigo-800 text-white focus:outline-none"
                >
                  <svg
                    class="w-5 h-5 transform rotate-90 -mr-px"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                    ></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </main>
        <!-- <nav class="flex w-72 h-screen bg-indigo-100">
          <div class="w-full flex mx-auto px-6 py-8">
            <div
              class="w-full h-full flex items-center justify-center text-gray-900 text-xl border-4 border-gray-900 border-dashed"
            >
              Rightbar
            </div>
          </div>
        </nav> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: "space",
  data() {
    return {
      space: {}
    };
  },
  async fetch() {
    return this.$axios
      .get("/spaces/" + this.$route.params.uid)
      .then(r => {
        console.log(r.data);
        this.space = r.data;
      })
      .catch(e => {
        console.log(e);
      });
  }
};
</script>

<style>
.discussion-content {
  height: calc(100vh - 70px);
}
</style>
