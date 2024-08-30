import { config } from "../config";
import { LoginDto } from "../models/LoginDto";
import BaseStore from "./BaseStore";

export default class LoginStore extends BaseStore<LoginDto> {
  constructor() {
    super(config.baseUrl!);
  }

  async login(data: LoginDto) {
    try {
      const response = await fetch(`${config.baseUrl}/login`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify(data),
      });
      if (!response.ok) {
        throw new Error(`Failed to login: ${response.statusText}`);
      }
      return await response.json();
    } catch (error) {
      console.error(error);
      throw error;
    }
  }
}
