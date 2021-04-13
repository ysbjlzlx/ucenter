import React from "react";
import { Menu } from "antd";
import { InertiaLink } from "@inertiajs/inertia-react";

export default function AppMenu() {
  return (
    <Menu mode="horizontal" theme="dark">
      <Menu.Item key="index">
        <InertiaLink href="/">首页</InertiaLink>
      </Menu.Item>
      <Menu.Item key="register" style={{ float: "right" }}>
        <InertiaLink href="/register">注册</InertiaLink>
      </Menu.Item>
      <Menu.Item key="login" style={{ float: "right" }}>
        <InertiaLink href="/login">登录</InertiaLink>
      </Menu.Item>
    </Menu>
  );
}
