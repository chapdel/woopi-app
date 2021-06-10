import Vue from "vue";
import Router from "vue-router";
import { scrollBehavior } from "~/utils";

Vue.use(Router);

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m);

const routes = [
  // main
  {
    path: "/",
    name: "home",
    component: page("index.vue")
  },
  {
    path: "/login",
    name: "login",
    component: page("auth/login.vue")
  },
  {
    path: "/signup",
    name: "register",
    component: page("auth/signup.vue")
  },
  {
    path: "/password/forgot",
    name: "password.forgot",
    component: page("auth/password/forgot.vue")
  },
  {
    path: "/reset-password/:token",
    name: "password.reset",
    component: page("auth/password/reset.vue")
  },
  {
    path: "/spaces",
    name: "spaces",
    component: page("spaces/index.vue")
  },
  {
    path: "/spaces/:uid",
    component: page("spaces/show.vue"),
    children: [
      {
        path: "",
        redirect: "home"
      },
      {
        path: "home",
        name: "spaces.home",
        component: page("spaces/show.vue")
      },
      {
        path: ":room",
        name: "spaces.show",
        component: page("spaces/chatlist.vue")
      }
    ]
  },

  {
    path: "/dm",
    name: "dm",
    component: page("dm/index.vue")
  }
];

export function createRouter() {
  return new Router({
    routes,
    scrollBehavior,
    mode: "history"
  });
}
