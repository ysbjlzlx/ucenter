import React, { useState, useEffect } from "react";
import { Menu } from "antd";
import { InertiaLink } from "@inertiajs/inertia-react";
import { profile } from "@/Api/User";
import { logout } from "@/Api/Auth";

const userMenu = () => {
  const [userProfile, setUserProfile] = useState({ email: "" });
  useEffect(() => {
    profile().then((response) => {
      if (response.data.code === "00000") {
        setUserProfile(response.data.data);
      }
    });
  }, []);
  const handleLogout = () => {
    logout().then(() => {
      window.localStorage.removeItem("access_token");
      window.location.href = "/";
    });
  };
  return (
    <Menu mode="horizontal" theme="dark">
      <Menu.Item key="index">
        <InertiaLink href="/">首页</InertiaLink>
      </Menu.Item>
      <Menu.SubMenu
        key="SubMenu"
        title={userProfile.email}
        style={{ float: "right" }}
      >
        <Menu.Item onClick={handleLogout}>退出</Menu.Item>
      </Menu.SubMenu>
    </Menu>
  );
};

const guestMenu = () => {
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
};

export default function AppMenu() {
  return window.localStorage.getItem("access_token") ? userMenu() : guestMenu();
}
