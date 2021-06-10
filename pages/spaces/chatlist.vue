<template>
  <div>
    <div class="h-screen flex flex-col">
      <main class="h-64 flex flex-col flex-grow text-white">
        <div class="overflow-hidden" v-if="$fetchState.pending">
          <div class="py-4 px-2 space-y-4 w-full mx-auto">
            <div class="animate-pulse flex space-x-4">
              <div class="space-y-2">
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
              </div>
              <div class="flex-1 space-y-4 py-1">
                <div class="h-1 bg-blue-300 rounded w-3/6"></div>
                <div class="space-y-2">
                  <div class="h-2 bg-blue-300 rounded w-1/4"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/5"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/3"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-4 px-2 space-y-4 w-full mx-auto">
            <div class="animate-pulse flex space-x-4">
              <div class="space-y-2">
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
              </div>
              <div class="flex-1 space-y-4 py-1">
                <div class="h-1 bg-blue-300 rounded w-3/6"></div>
                <div class="space-y-2">
                  <div class="h-2 bg-blue-300 rounded w-1/4"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/5"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/3"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-4 px-2 space-y-4 w-full mx-auto">
            <div class="animate-pulse flex space-x-4">
              <div class="space-y-2">
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
              </div>
              <div class="flex-1 space-y-4 py-1">
                <div class="h-1 bg-blue-300 rounded w-3/6"></div>
                <div class="space-y-2">
                  <div class="h-2 bg-blue-300 rounded w-1/4"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/5"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/3"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-4 px-2 space-y-4 w-full mx-auto">
            <div class="animate-pulse flex space-x-4">
              <div class="space-y-2">
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
              </div>
              <div class="flex-1 space-y-4 py-1">
                <div class="h-1 bg-blue-300 rounded w-3/6"></div>
                <div class="space-y-2">
                  <div class="h-2 bg-blue-300 rounded w-1/4"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/5"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/3"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-4 px-2 space-y-4 w-full mx-auto">
            <div class="animate-pulse flex space-x-4">
              <div class="space-y-2">
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
              </div>
              <div class="flex-1 space-y-4 py-1">
                <div class="h-1 bg-blue-300 rounded w-3/6"></div>
                <div class="space-y-2">
                  <div class="h-2 bg-blue-300 rounded w-1/4"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/5"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/3"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-4 px-2 space-y-4 w-full mx-auto">
            <div class="animate-pulse flex space-x-4">
              <div class="space-y-2">
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
              </div>
              <div class="flex-1 space-y-4 py-1">
                <div class="h-1 bg-blue-300 rounded w-3/6"></div>
                <div class="space-y-2">
                  <div class="h-2 bg-blue-300 rounded w-1/4"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/5"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/3"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-4 px-2 space-y-4 w-full mx-auto">
            <div class="animate-pulse flex space-x-4">
              <div class="space-y-2">
                <div class="rounded-md bg-blue-300 h-8 w-8"></div>
              </div>
              <div class="flex-1 space-y-4 py-1">
                <div class="h-1 bg-blue-300 rounded w-3/6"></div>
                <div class="space-y-2">
                  <div class="h-2 bg-blue-300 rounded w-1/4"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/5"></div>
                  <div class="h-2 bg-blue-300 rounded w-1/3"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="overflow-y-auto"
          id="chatlist"
          ref="chatlist"
          v-if="!$fetchState.pending"
        >
          <div
            class="w-full flex  px-2 py-1 space-x-4"
            v-for="(message, index) in room.messages"
            :class="{
              'bg-gray-100 hover:bg-gray-200': message.created_at,
              'bg-red-100 hover:bg-red-200': !message.created_at
            }"
            :key="index"
          >
            <span
              v-if="!lastSenderIsMe(index)"
              class="p-2 rounded-md text-white h-8 w-8 bg-indigo-400"
            >
              <solid-user-icon class="h-4 w-4"></solid-user-icon>
              <solid-user-icon class="h-4 w-4"></solid-user-icon>
            </span>
            <span
              class="rounded-md text-transparent bg-transparent  h-1 w-8 "
              v-else
              ><solid-user-icon
                class="h-1 w-4 text-transparent"
              ></solid-user-icon
            ></span>
            <div>
              <div v-if="!lastSenderIsMe(index)">
                <small class="text-sm font-semibold text-gray-800">{{
                  message.type != "default" ? "Woppi Bot" : message.user.name
                }}</small>
                <small
                  v-if="message.type != 'system'"
                  v-text="
                    message.created_at
                      ? $moment(message.created_at).format('LLL')
                      : 'Just now'
                  "
                  class="text-xs text-gray-700"
                />
              </div>
              <div class="text-sm text-gray-600">
                {{ message.content }}
              </div>
            </div>
          </div>
        </div>
      </main>
      <footer class="mb-12">
        <div class="flex flex-row  items-center  bottom-0 w-full">
          <div
            class="ml-2 mx-auto text-center text-xs font-semibold text-white border-gray w-full border bg-indigo-600 rounded-md h-12 px-2 space-x-3 mr-2 pt-1.5"
            v-if="0 == 'guest'"
          >
            <span>You are not part of this space!!!</span>
            <button
              type="button"
              @click.prevent="joinSpace()"
              class="w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-1 text-xs bg-gray-100 text-base font-medium text-indigo-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
            >
              <svg
                v-if="form.busy"
                class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
              >
                <circle
                  class="opacity-25"
                  cx="12"
                  cy="12"
                  r="10"
                  stroke="currentColor"
                  stroke-width="4"
                ></circle>
                <path
                  class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                ></path>
              </svg>
              Join now
            </button>
          </div>
          <div
            v-else
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
                v-model="form.message"
                @keyup.enter="sendMessage"
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
              @click.prevent="sendMessage"
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
      </footer>
    </div>

    <!--
     -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      room: {},
      form: {
        busy: false,
        message: "",
        errors: ""
      }
    };
  },
  fetchOnServer: false,
  async fetch() {
    await this.$axios
      .get("/rooms/" + this.$route.params.room)
      .then(async r => {
        this.room = r.data;
      })
      .catch(e => {
        console.log(e);
      });
  },
  methods: {
    async sendMessage() {
      this.form.errors = {};
      this.form.busy = true;
      const fuid = this.$uuid.v4();
      await this.room.messages.push({
        content: this.form.message,
        user: this.$auth.user,
        fuid: fuid,
        created_at: null,
        type: "default"
      });

      this.scrollToEndOfChat();

      const message = this.form.message;
      this.form.message = "";

      await this.$axios
        .post("/rooms/" + this.$route.params.room + "/message", {
          message: message,
          fuid: fuid
        })
        .then(r => {
          this.room.messages[
            this.room.messages.findIndex(x => x.fuid === r.data.fuid)
          ].created_at = r.data.created_at;

          /* this.space.rooms[
            this.space.rooms.findIndex(x => x.uid == this.$route.params.room)
          ].lastMessage = r.data; */
        })
        .catch(e => {});
    },
    lastSenderIsMe(index) {
      if (index > 0) {
        return (
          this.room.messages[index].user_id ==
            this.room.messages[index - 1].user_id &&
          this.room.messages[index - 1].type != "system"
        );
      }

      return false;
    },
    scrollToEndOfChat() {
      const el = this.$refs.chatlist;
      if (el) el.scrollTop = el.scrollHeight;
    },
    async joinSpace() {
      this.form.busy = true;
      await this.$axios
        .post("/spaces/" + this.$route.params.uid + "/join")
        .then(r => {
          this.$fetch();
          this.form.busy = false;
        })
        .catch(e => {
          this.form.busy = false;
        });
    }
  },
  watch: {
    $route: function(newRoute, oldRoute) {
      /*   this.answer = 'Waiting for you to stop typing...'
      this.debouncedGetAnswer() */
      if (newRoute.params.room != oldRoute.params.room) {
        this.$fetch();
      }
    }
  }
};
</script>

<style></style>
