import React from "react";
import { Menu } from "antd";

const handleSiderMenuClick = (e) => {
  switch (e.key) {
    case "user:account:changePassword":
      window.location.href = "/home/account/password/change";
      break;
    case "user:account:changeAvatar":
      window.location.href = "/home/account/avatar/change";
      break;
    case "user:account:changeProfile":
      window.location.href = "/home/account/profile/change";
      break;
    case "user:account:destroy":
      window.location.href = "/home/account/destroy";
      break;
  }
};

export default function AppSider() {
  return (
    <Menu onClick={handleSiderMenuClick} mode="inline" theme="dark">
      <Menu.ItemGroup key="g1" title="个人中心">
        <Menu.Item key="user:account:changePassword">修改密码</Menu.Item>
        <Menu.Item key="user:account:changeAvatar">修改头像</Menu.Item>
        <Menu.Item key="user:account:changeProfile">修改个人资料</Menu.Item>
        <Menu.Item key="user:account:destroy">删除账号</Menu.Item>
      </Menu.ItemGroup>
    </Menu>
  );
}
