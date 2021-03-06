<template>
  <div>
    <div class="flex-1 flex flex-col overflow-hidden">
      <div class="flex h-full">
        <div class="h-screen hidden md:flex flex-col w-72">
          <header class="p-2 bg-gray-300 text-gray-800 text-sm font-bold">
            Rooms
          </header>
          <main class="h-64 bg-indigo-100 flex flex-grow justify-center">
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
                    <div class="h-2 bg-indigo-300 rounded w-1/5"></div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="w-72 flex mx-auto p-2 overflow-y-auto overflow-x-hidden scrollbar-thin scrollbar-thumb-indigo-500 scrollbar-track-indigo-300 scrollbar-track-rounded-md"
              v-if="!$fetchState.pending"
            >
              <div class="space-y-0.5">
                <nuxt-link
                  :to="{
                    name: 'spaces.show',
                    params: {
                      uid: space.uid,
                      room: croom.uid
                    }
                  }"
                  v-for="(croom, index) in space.rooms"
                  :key="index"
                  class="cursor-pointer relative space-x-2 flex hover:bg-indigo-200 focus:bg-indigo-200 px-2 py-1 text-sm rounded-md w-68 hover-trigger"
                  active-class="bg-indigo-200"
                >
                  <span
                    class="p-2.5 bg-purple-400 text-white w-9 h-9 rounded-md"
                    ><outline-hashtag-icon
                      class="h-4 w-4"
                    ></outline-hashtag-icon
                  ></span>
                  <div class="truncate space-y-0.5">
                    <span class="block font-semibold ">{{ croom.name }}</span>
                    <small class="text-xs text-gray-600">{{
                      croom.lastMessage.content
                    }}</small>
                  </div>
                  <button
                    class="absolute text-white font-semibold bg-indigo-400 rounded-md content-between space-y-1 p-1 hover-target right-0"
                    @click.prevent="openUpdateRoomModal(croom)"
                  >
                    <outline-cog-icon
                      class="h-3 w-3 cursor-pointer"
                    ></outline-cog-icon>
                  </button>
                </nuxt-link>
              </div>
            </div>
          </main>
        </div>
        <main class="flex flex-col w-full h-screen bg-gray-50">
          <div
            class="space-x-2 flex justify-between items-center bg-gray-200 px-2 py-2"
          >
            <div
              v-if="$fetchState.pending"
              class="flex space-x-2 truncate animate-pulse items-center"
            >
              <span
                class="p-4 w-8 h-8 text-white rounded-md bg-purple-500"
              ></span>
              <div class="h-4 w-32 bg-indigo-300 rounded-md"></div>
            </div>
            <div
              v-if="!$fetchState.pending"
              class="flex space-x-2 truncate items-center"
            >
              <span class="p-1.5 w-8 h-8 text-white rounded-md bg-purple-500"
                ><outline-hashtag-icon class="h-5 w-5"></outline-hashtag-icon
              ></span>
              <span>{{ space.name }}</span>
            </div>

            <div
              v-if="$fetchState.pending"
              class="space-x-4 animate-pulse flex"
            >
              <div class="h-4 w-14 rounded-md bg-indigo-300"></div>
              <div class="h-4 w-14 rounded-md bg-indigo-300"></div>
            </div>
            <div v-else class="flex space-x-2">
              <div
                v-show="space"
                @click="showMembers = !showMembers"
                class="flex space-x-1 text-indigo-500 cursor-pointer px-2"
              >
                <outline-users-icon class="h-4 w-4"></outline-users-icon>
                <span class="text-sm">{{
                  space.members ? space.members.length : 1
                }}</span>
              </div>
              <div
                v-show="space"
                class="flex space-x-1 text-gray-500 cursor-pointer px-2"
              >
                <div class="relative inline-block text-left">
                  <div
                    class="cursor-pointer"
                    @click="showSpaceMenu = !showSpaceMenu"
                  >
                    <solid-dots-vertical-icon
                      class="h-4 w-4"
                    ></solid-dots-vertical-icon>
                  </div>

                  <div
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                    v-if="showSpaceMenu"
                    role="menu"
                    @blur="hideSpaceMenu"
                    aria-orientation="vertical"
                    aria-labelledby="menu-button"
                    tabindex="-1"
                  >
                    <div class="py-1" role="none">
                      <a
                        href="#"
                        class="text-gray-700 block px-4 py-2 text-sm"
                        role="menuitem"
                        @click="hideSpaceMenu"
                        tabindex="-1"
                        id="menu-item-0"
                        >Add Members</a
                      >
                      <a
                        href="#"
                        class="text-gray-700 block px-4 py-2 text-sm"
                        role="menuitem"
                        @click="openCreateRoomModal()"
                        tabindex="-1"
                        id="menu-item-1"
                        >Add Room</a
                      >
                      <a
                        href="#"
                        class="text-gray-700 block px-4 py-2 text-sm"
                        role="menuitem"
                        tabindex="-1"
                        @click.prevent="openUpdateSpaceModal()"
                        id="menu-item-2"
                        >Edit Space</a
                      >
                      <a
                        href="#"
                        class="text-gray-700 block px-4 py-2 text-sm"
                        role="menuitem"
                        tabindex="-1"
                        id="menu-item-3"
                        @click="leaveSpace"
                        >Leave Space</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-col h-screen">
            <nuxt />
          </div>
        </main>
        <nav
          class="flex w-96 h-screen flex-col bg-indigo-100 transition delay-150 border-2 border-light-indigo-900 duration-300 ease-in-out"
          v-if="showMembers"
        >
          <header class="p-2 bg-gray-300 text-gray-800 text-sm font-bold">
            Members
          </header>
          <div
            class="p-5 space-y-3 bg-gray-200 flex flex-col text-xs text-center"
          >
            <div class="mx-auto text-sm">Add some friends!</div>
            <button
              type="button"
              class="rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Invite People
            </button>
          </div>
          <div class="w-full flex flex-glow mx-auto p-2">
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
      </div>
    </div>
    <div
      class="fixed z-10 inset-0 overflow-y-auto"
      aria-labelledby="modal-title"
      role="dialog"
      v-if="createRoomModal.show"
      aria-modal="true"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          aria-hidden="true"
        ></div>
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >
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
                  <solid-hashtag-icon
                    class="h-5 w-5 text-indigo-600"
                  ></solid-hashtag-icon>
                </div>
                <div>Create a room</div>
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
                  Brief description for your room.
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
              @click.prevent="submitRoom"
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
              <spinner v-if="form.busy"></spinner> Create
            </button>
            <button
              type="button"
              @click="hiddeRoomModal"
              :disabled="form.busy"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="fixed z-10 inset-0 overflow-y-auto"
      aria-labelledby="modal-title"
      role="dialog"
      v-if="showUpdateSpaceModal"
      aria-modal="true"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          aria-hidden="true"
        ></div>

        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >

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
                <div>Update a space</div>
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
                  v-model="formUpdateSpace.name"
                  class="appearance-none rounded-none relative block w-full px-3 py-3 border"
                  :class="{
                    'border-red-300 placeholder-red-500 text-red-900 rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                      formUpdateSpace.errors && formUpdateSpace.errors.name,
                    'border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                      formUpdateSpace.errors && !formUpdateSpace.errors.name
                  }"
                />
                <span
                  v-if="formUpdateSpace.errors && formUpdateSpace.errors.name"
                  class="text-sm text-red-500"
                  >{{ formUpdateSpace.errors.name[0] }}</span
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
                        formUpdateSpace.errors &&
                        formUpdateSpace.errors.description,
                      'border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                        formUpdateSpace.errors &&
                        !formUpdateSpace.errors.description
                    }"
                  />
                  <span
                    v-if="
                      formUpdateSpace.errors &&
                        formUpdateSpace.errors.description
                    "
                    class="text-sm text-red-500"
                    >{{ formUpdateSpace.errors.description[0] }}</span
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
                      v-model="formUpdateSpace.visibility"
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
                      v-model="formUpdateSpace.visibility"
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
                      v-model="formUpdateSpace.visibility"
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
              :disabled="formUpdateSpace.busy"
              @click.prevent="submitUpdateSpace"
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
              <spinner v-if="formUpdateSpace.busy"></spinner> Save
            </button>
            <button
              type="button"
              @click="hiddeUpdateSpaceModal"
              :disabled="formUpdateSpace.busy"
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
  layout: "space",
  head() {
    return {
      titleTemplate:
        "%s | " + (this.space.name != null ? this.space.name : "Spaces")
    };
  },
  data() {
    return {
      space: {},
      form: {
        description: "",
        name: "",
        visibility: "public",
        errors: {},
        busy: false
      },
      formUpdateSpace: {
        description: "",
        name: "",
        visibility: "public",
        errors: {},
        busy: false
      },
      showMembers: false,
      showSpaceMenu: false,
      showUpdateSpaceModal: false,
      createRoomModal: {
        show: false
      },
      settingModal: false
    };
  },
  fetchOnServer: false,
  async fetch() {
    this.space = await this.$axios.$get("/spaces/" + this.$route.params.uid);
  },
  methods: {
    hideSpaceMenu() {
      this.showSpaceMenu = false;
    },
    openCreateRoomModal() {
      this.createRoomModal.show = true;
      this.showSpaceMenu = false;
    },
    openUpdateSpaceModal() {
      this.showUpdateSpaceModal = true;
      this.showSpaceMenu = false;
      this.formUpdateSpace.name = this.space.name;
      this.formUpdateSpace.description = this.space.description;
      this.formUpdateSpace.visibility = this.space.visibility;
      this.formUpdateSpace.errors = {};
    },
    hiddeRoomModal() {
      this.createRoomModal.show = false;
      this.form.name = "";
      this.form.description = "";
      this.form.visibility = "public";
      this.form.errors = {};
    },
    hiddeUpdateSpaceModal() {
      this.showUpdateSpaceModal = false;
      this.formUpdateSpace.name = "";
      this.formUpdateSpace.description = "";
      this.formUpdateSpace.visibility = "public";
      this.formUpdateSpace.errors = {};
    },
    openUpdateRoomModal(room) {
      this.settingModal = true;
      this.form.name = room.name;
      this.form.description = room.description;
      this.form.visibility = room.visibility;
    },
    async submitRoom() {
      this.form.errors = {};
      this.form.busy = true;
      await this.$axios
        .post("/spaces/" + this.$route.params.uid + "/rooms", this.form)
        .then(r => {
          this.space.rooms.push(r.data);
          this.form.busy = false;
          this.hiddeRoomModal();
          this.$router.push({
            namr: "spaces.show",
            params: {
              uid: this.$route.params.uid,
              room: r.data.uid
            }
          });
        })
        .catch(e => {
          this.form.busy = false;
        });
    },
    async submitUpdateSpace() {
      this.formUpdateSpace.errors = {};
      this.formUpdateSpace.busy = true;
      await this.$axios
        .post("/spaces/" + this.$route.params.uid, this.formUpdateSpace)
        .then(r => {
          this.space = r.data;
          this.formUpdateSpace.busy = false;
          this.hiddeUpdateSpaceModal();
        })
        .catch(e => {
          this.formUpdateSpace.busy = false;
        });
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
    },
    async leaveSpace() {
      this.showSpaceMenu = false;
      const loading = this.$loading({
        lock: true,
        text: "Leaving Space",
        background: " rgba(55, 56, 78, 0.5)"
      });

      await this.$axios
        .delete("/spaces/" + this.$route.params.uid + "/leave")
        .then(r => {
          loading.close();
          this.$router.push({
            name: "spaces"
          });
        })
        .catch(e => {
          loading.close();
          alert("failed to leave space");
        });
    }
  },
  mounted() {
    //this.scrollToEndOfChat();
  }
};
</script>

<style>
.hover-trigger .hover-target {
  display: none;
}

.hover-trigger:hover .hover-target {
  display: block;
}
</style>
