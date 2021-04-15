import React from "react";
import { Menu } from "antd";

const handleSiderMenuClick = (e) => {
  switch (e.key) {
    case "user:account:changePassword":
      window.location.href = "/home/account/password/change";
      break;
  }
};

export default function AppSider() {
  return (
    <Menu onClick={handleSiderMenuClick} mode="inline" theme="dark">
      <Menu.ItemGroup key="g1" title="个人中心">
        <Menu.Item key="user:account:changePassword">修改密码</Menu.Item>
      </Menu.ItemGroup>
    </Menu>
  );
}
