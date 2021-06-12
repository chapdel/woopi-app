import Vue from "vue";

import {
  /* Autocomplete,
  Dropdown,
  DropdownMenu,
  DropdownItem,
  Input,
  InputNumber,
  Radio,
  RadioGroup,
  RadioButton,
  Checkbox,
  CheckboxButton,
  CheckboxGroup,
  Switch,
  Select,
  Option,
  DatePicker,
  Container,
  Timeline,
  TimelineItem, */
  Loading
  /* MessageBox,
  Message,
  Notification,
  Dialog,
  Alert,
  Upload */
} from "element-ui";

/* Vue.use(Dialog);
Vue.use(Autocomplete);
Vue.use(Dropdown);
Vue.use(DropdownMenu);
Vue.use(DropdownItem);
Vue.use(Input);
Vue.use(InputNumber);
Vue.use(Radio);
Vue.use(Alert);
Vue.use(RadioGroup);
Vue.use(RadioButton);
Vue.use(Checkbox);
Vue.use(CheckboxButton);
Vue.use(CheckboxGroup);
Vue.use(Switch);
Vue.use(Select);
Vue.use(Option);
Vue.use(DatePicker);
Vue.use(Container);
Vue.use(Timeline);
Vue.use(TimelineItem);
Vue.use(Upload); */
Vue.use(Loading.directive);

Vue.prototype.$loading = Loading.service;
/* Vue.prototype.$msgbox = MessageBox;
Vue.prototype.$alert = MessageBox.alert;
Vue.prototype.$confirm = MessageBox.confirm;
Vue.prototype.$prompt = MessageBox.prompt;
Vue.prototype.$notify2 = Notification;
Vue.prototype.$message = Message; */
