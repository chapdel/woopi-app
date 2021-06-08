<template>
  <div class="min-h-screen flex w-full">
    <div
      class="h-screen flex flex-wrap content-between w-20 bg-indigo-200 p-4 "
    >
      <div class="space-y-2">
        <nuxt-link :to="{ name: 'discover' }">
          <img class="rounded-md h-12 w-12" src="/icon.png" alt=""
        /></nuxt-link>
        <nuxt-link
          :to="{ name: 'spaces' }"
          tag="button"
          active-class="outline-none ring-2 ring-offset-2 ring-indigo-500"
          class="w-10 h-10 cursor-pointer mx-1 border border-transparent text-sm font-medium rounded-lg hover:rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 pl-2"
        >
          <outline-server-icon class="h-5 w-5"></outline-server-icon>
        </nuxt-link>
        <!-- <nuxt-link
          :to="{ name: 'dm' }"
          tag="button"
          class="w-10 h-10 cursor-pointer mx-1 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 pl-2"
        >
          <outline-bell-icon class="h-5 w-5"></outline-bell-icon>
        </nuxt-link> -->
        <button
          class="w-10 h-10 cursor-pointer mx-1 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 pl-2"
          @click="createModal.show = true"
        >
          <outline-plus-icon class="h-5 w-5"></outline-plus-icon>
        </button>
      </div>
      <button
        class="w-10 h-10 cursor-pointer mx-1 border border-transparent text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none ring-2 ring-offset-2 ring-green-500 pl-2"
      >
        <outline-user-icon class="h-5 w-5"></outline-user-icon>
      </button>
    </div>
    <div class="overflow-y-hidden h-screen w-screen">
      <nuxt></nuxt>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div
      class="fixed z-10 inset-0 overflow-y-auto"
      aria-labelledby="modal-title"
      role="dialog"
      v-if="createModal.show"
      aria-modal="true"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <!--
      Background overlay, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          aria-hidden="true"
        ></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >

        <!--
      Modal panel, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        To: "opacity-100 translate-y-0 sm:scale-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100 translate-y-0 sm:scale-100"
        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    -->
        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="mt-3 space-y-2 sm:mt-0 sm:ml-4">
              <h3
                class="text-lg space-x-2 flex items-center content-start leading-6 font-medium text-gray-900"
                id="modal-title"
              >
                <div
                  class="mx-auto flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-md bg-indigo-100 sm:mx-0 "
                >
                  <!-- Heroicon name: outline/exclamation -->
                  <solid-server-icon
                    class="h-5 w-5 text-indigo-600"
                  ></solid-server-icon>
                </div>
                <div>Create a space</div>
              </h3>
              <div>
                <p class="text-sm text-gray-500">
                  Are you sure you want to deactivate your account? All of your
                  data will be permanently removed. This action cannot be
                  undone.
                </p>
              </div>
              <div class="w-full">
                <label
                  for="name"
                  class="block text-sm font-medium text-gray-700"
                >
                  Name
                </label>
                <input
                  id="name"
                  autocomplete="off"
                  required=""
                  v-model="form.name"
                  class="appearance-none rounded-none relative block w-full px-3 py-3 border"
                  :class="{
                    'border-red-300 placeholder-red-500 text-red-900 rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                      form.errors && form.errors.name,
                    'border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                      form.errors && !form.errors.name
                  }"
                />
                <span
                  v-if="form.errors && form.errors.name"
                  class="text-sm text-red-500"
                  >{{ form.errors.name[0] }}</span
                >
              </div>
              <div class="w-full">
                <label
                  for="about"
                  class="block text-sm font-medium text-gray-700"
                >
                  About
                </label>
                <div class="mt-1">
                  <textarea
                    id="about"
                    name="about"
                    rows="3"
                    class="appearance-none rounded-none relative block w-full px-3 py-3 border"
                    :class="{
                      'border-red-300 placeholder-red-500 text-red-900 rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                        form.errors && form.errors.description,
                      'border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                        form.errors && !form.errors.description
                    }"
                  />
                  <span
                    v-if="form.errors && form.errors.description"
                    class="text-sm text-red-500"
                    >{{ form.errors.description[0] }}</span
                  >
                </div>
                <p class="mt-2 text-sm text-gray-500">
                  Brief description for your space.
                </p>
              </div>
              <div>
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input
                      id="visibility_public"
                      name="visibility"
                      type="radio"
                      value="public"
                      v-model="form.visibility"
                      class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    />
                  </div>
                  <div class="ml-3 text-sm">
                    <label
                      for="visibility_public"
                      class="font-medium text-gray-700"
                      >Public
                      <p class="text-gray-500">
                        Get notified when a candidate applies for a job.
                      </p>
                    </label>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input
                      id="visibility_private"
                      name="visibility"
                      type="radio"
                      v-model="form.visibility"
                      value="private"
                      class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    />
                  </div>
                  <div class="ml-3 text-sm">
                    <label
                      for="visibility_private"
                      class="font-medium text-gray-700"
                      >Protected
                      <p class="text-gray-500">
                        Get notified when a candidate accepts or rejects an
                        offer.
                      </p></label
                    >
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input
                      id="visibility_private"
                      name="visibility"
                      type="radio"
                      v-model="form.visibility"
                      value="private"
                      class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    />
                  </div>
                  <div class="ml-3 text-sm">
                    <label
                      for="visibility_private"
                      class="font-medium text-gray-700"
                      >Private
                      <p class="text-gray-500">
                        Get notified when a candidate accepts or rejects an
                        offer.
                      </p></label
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
              type="button"
              :disabled="form.busy"
              @click.prevent="submit"
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
              <spinner v-if="form.busy"></spinner> Create
            </button>
            <button
              type="button"
              @click="hiddeModal"
              :disabled="form.busy"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: ["auth"],
  data() {
    return {
      createModal: {
        show: false
      },
      form: {
        name: "",
        description: "",
        busy: false,
        visibility: "public",
        errors: {}
      }
    };
  },
  methods: {
    hiddeModal() {
      this.createModal.show = false;
      this.form = {
        name: "",
        description: "",
        busy: false,
        visibility: "public",
        errors: {}
      };
    },
    async submit() {
      this.form.busy = true;
      this.form.errors = {};
      this.$axios
        .post("/spaces", this.form)
        .then(async r => {
          console.log(r.data);
          this.form.busy = false;
          this.hiddeModal();
          this.$router.push({
            name: "spaces.show",
            params: {
              uid: r.data.uid,
              room: r.data.home.uid
            }
          });
        })
        .catch(e => {
          this.form.busy = false;
          if (
            e &&
            e.response &&
            e.response.status &&
            e.response.status == 422
          ) {
            this.form.errors = e.response.data.errors;
          } else {
            //this.$toast.error(this.$t("errors.e500.title"));
          }
        });
    }
  }
};
</script>

<style></style>
