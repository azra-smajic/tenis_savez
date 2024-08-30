import { action, observable } from "mobx";
import { toast } from "react-toastify";
import i18n from "../i18n";
import { LoginDto } from "../models/LoginDto";
import LoginStore from "../stores/LoginStore";

export default class LoginViewStore {
  @observable loginModel: LoginDto = {};
  loginStore: LoginStore;

  constructor() {
    this.loginStore = new LoginStore();
  }

  @action.bound
  setEmail = (e: any) => {
    this.loginModel.email = e.target.value;
  };

  @action.bound
  setPassword = (e: any) => {
    this.loginModel.password = e.target.value;
  };

  handleSubmit = async (e: any) => {
    e.preventDefault();
    let result = await this.loginStore.login(this.loginModel);
    if (result) {
      toast.success(toast.success(i18n.t("login.successMessage")));
    } else {
    }
  };
}
