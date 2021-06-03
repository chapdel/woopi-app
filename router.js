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
  }
];

export function createRouter() {
  return new Router({
    routes,
    scrollBehavior,
    mode: "history"
  });
}
