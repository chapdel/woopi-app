<template>
  <div>
    <div class="flex-1 flex flex-col overflow-hidden">
      <div class="flex h-full">
        <nav class="flex w-80 h-screen bg-indigo-100" v-if="spaces.length > 0">
          <div class="w-full flex mx-auto p-2 overflow-y-auto">
            <div class="space-y-0.5 block">
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
                class="cursor-pointer space-x-2 flex items-center hover:bg-indigo-200 focus:bg-indigo-200 px-2 py-2 rounded-md w-72"
              >
                <span
                  class="p-1 hover:animate-pulse ring ring-offset-2 hover:ring-green-500 w-6 h-6 rounded-md"
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
    return this.$axios
      .get("/spaces")
      .then(r => {
        console.log(r.data);
        this.spaces = r.data;
      })
      .catch(e => {
        console.log(e);
      });
  },
  /* methods: {
    async sendMessage() {
      this.form.errors = {};
      this.form.busy = true;
      const fuid = this.$uuid.v4();
      await this.messages.push({
        content: this.form.message,
        space: this.$auth.space,
        fuid: fuid,
        created_at: null
      });

      this.scrollToEndOfChat();

      const message = this.form.message;
      this.form.message = "";

      await this.$axios
        .post("/spaces/" + this.$route.params.uid + "/message", {
          message: message,
          fuid: fuid
        })
        .then(r => {
          this.messages[
            this.messages.findIndex(x => x.fuid === r.data.fuid)
          ].created_at = r.data.created_at;
        })
        .catch(e => {});
    },
    lastSenderIsMe(index) {
      if (index > 0) {
        return this.messages[index].space_id == this.messages[index - 1].space_id;
      }

      return false;
    },
    scrollToEndOfChat() {
      const el = this.$refs.chatlist;
      // alert(el.scrollHeight);
      el.scrollTop = el.scrollHeight;
      //alert(el.scrollTop);
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
  }, */
  mounted() {
    //this.scrollToEndOfChat();
  }
};
</script>

<style>
.discussion-content {
  height: calc(100vh - 70px);
}
</style>
