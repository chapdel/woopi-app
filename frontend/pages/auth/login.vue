<template>
  <div
    class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="/woopi-full.png" alt="Woopi" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Sign in to your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Or
          {{ " " }}
          <nuxt-link
            :to="{ name: 'register' }"
            class="font-medium text-indigo-600 hover:text-indigo-500"
          >
            create your account and join the mob
          </nuxt-link>
        </p>
      </div>
      <form class="mt-8 space-y-6" @submit.prevent="login" method="POST">
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <span
              v-if="form.errors && form.errors.email"
              class="text-sm text-red-500"
              >{{ form.errors.email[0] }}</span
            >
            <label for="email-address" class="sr-only">Email address</label>
            <input
              id="email-address"
              name="email"
              type="email"
              autocomplete="email"
              v-model="form.email"
              required=""
              class="appearance-none rounded-none relative block w-full px-3 py-3 border"
              placeholder="Email address"
              :class="{
                'border-red-300 placeholder-red-500 text-red-900 rounded-t-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm':
                  form.errors && form.errors.email,
                'border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                  form.errors && !form.errors.email
              }"
            />
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required=""
              v-model="form.password"
              class="appearance-none rounded-none relative block w-full px-3 py-3 border"
              :class="{
                'border-red-300 placeholder-red-500 text-red-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                  form.errors && form.errors.password,
                'border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm':
                  form.errors && !form.errors.password
              }"
              placeholder="Password"
            />
            <span
              v-if="form.errors && form.errors.password"
              class="text-sm text-red-500"
              >{{ form.errors.password[0] }}</span
            >
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember_me"
              name="remember_me"
              type="checkbox"
              class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
            />
            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
              Remember me
            </label>
          </div>

          <div class="text-sm">
            <button
              @click.prevent="sendPasswordResetLink"
              class="font-medium text-indigo-600 hover:text-indigo-500"
            >
              Forgot your password?
            </button>
          </div>
        </div>

        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            :disabled="form.busy"
          >
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <spinner v-if="form.busy" />

              <solid-lock-closed-icon
                v-else
                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
              />
            </span>

            Sign in
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  middleware: ["guest"],
  head() {
    return {
      title: "Sign in to your account"
    };
  },
  data() {
    return {
      form: {
        email: "",
        password: "",
        busy: false,
        errors: {}
      }
    };
  },
  methods: {
    async login() {
      this.form.errors = {};
      this.form.busy = true;
      try {
        await this.$auth.loginWith("local", {
          data: this.form
        });
        this.form.busy = false;
        // Redirect home.
        // this.$router.push({ name: "spaces" });
      } catch (e) {
        this.form.busy = false;
        if (e && e.response && e.response.status && e.response.status == 422) {
          this.form.errors = e.response.data.errors;
        } else {
          /* this.$toast.error(
            this.$t("Communication error with the Notch server")
          ); */
          console.error(e);
        }
      }
    },
    async sendPasswordResetLink() {
      this.form.errors = {};
      await this.$axios
        .post("/auth/password/request", this.form)
        .then(r => {})
        .catch(e => {
          if (
            e &&
            e.response &&
            e.response.status &&
            e.response.status == 422
          ) {
            this.form.errors = e.response.data.errors;
          } else {
            /* this.$toast.error(
            this.$t("Communication error with the Notch server")
          ); */
            console.error("internal server error");
          }
        });
    }
  },
  mounted() {}
};
</script>

<style></style>
