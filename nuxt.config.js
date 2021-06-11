export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: "woopi-web",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "" }
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: ["~/plugins/helpers"],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
    "@nuxtjs/tailwindcss",
    "@nuxt-hero-icons/outline/nuxt",
    "@nuxt-hero-icons/solid/nuxt",
    [
      "@nuxtjs/moment",
      {
        locales: ["fr"],
        defaultLocale: "en",
        timezone: true,
        defaultTimezone: "Africa/Douala"
      }
    ]
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    "@nuxtjs/axios",
    // https://go.nuxtjs.dev/pwa
    "@nuxtjs/pwa",
    "@nuxtjs/router",
    "@nuxtjs/auth-next",
    "@nuxtjs/dotenv",
    "@dansmaculotte/nuxt-security"
  ],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    baseURL: process.env.API_URL,
    retry: {
      retries: 3
    },
    debug: process.env.APP_DEBUUG || false,
    headers: {
      common: {
        Accept: "application/json",
        "Content-Type": "application/json"
      },
      delete: {},
      get: {},
      post: {},
      put: {},
      head: {},
      patch: {}
    },
    progress: false,
    withCredentials: true
  },
  auth: {
    strategies: {
      local: {
        _scheme: "local",
        endpoints: {
          login: {
            url: "/auth/login",
            method: "post",
            propertyName: "token"
          },
          logout: {
            url: "/auth/logout",
            method: "post"
          },
          user: {
            url: "/auth/user",
            method: "get",
            propertyName: false
          }
        },
        // tokenRequired: true,
        tokenType: "Bearer",
        token_key: "token",
        // globalToken: true,
        autoFetchUser: true
      }
    },
    redirect: {
      login: "/login",
      logout: "/",
      callback: "/login",
      home: "/spaces"
    }
  },
  server: {
    port: 3000, // default: 3000
    host: "localhost" // default: localhost
  },
  tailwindcss: {
    jit: true
    // add '~tailwind.config` alias
    //exposeConfig: true
  },

  security: {
    hsts: {
      maxAge: 63072000,
      includeSubDomains: true,
      preload: true
    },
    referrer: "same-origin",
    securityFile: {
      contacts: [
        "mailto:security@woopi.test",
        process.env.BASE_URL + "/security"
      ],
      // or contacts: 'mailto:security@example.com'
      canonical: process.env.BASE_URL + "/.well-know/security.txt",
      preferredLanguages: ["fr", "en", "es"],
      // or preferredLanguages: 'fr',
      //encryptions: [process.env.BASE_URL + "/pgp-key.txt"],
      // or encryptions: 'https://example.com/pgp-key.txt',
      acknowledgments: [process.env.BASE_URL + "/hall-of-fame"],
      // or acknowledgments: 'https://example.com/hall-of-fame.html',
      policies: [process.env.BASE_URL + "/policy"],
      // or policies: 'https://example.com/policy.html',
      hirings: [process.env.BASE_URL + "/career"]
      // or hirings: 'https://example.com/jobs.html'
    }
  },

  // PWA module configuration: https://go.nuxtjs.dev/pwa
  pwa: {
    manifest: {
      lang: "en"
    }
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {}
};
