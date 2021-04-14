import React from "react";
import { Menu } from "antd";

export default function AppSider() {
  return (
    <Menu mode="inline" theme="dark">
      <Menu.ItemGroup key="g1" title="Item 1">
        <Menu.Item key="1">Option 1</Menu.Item>
        <Menu.Item key="2">Option 2</Menu.Item>
      </Menu.ItemGroup>
    </Menu>
  );
}
