import React from "react";
import { Layout } from "antd";
import AppMenu from "./AppMenu";
import AppSider from "./AppSider";

const { Header, Footer, Sider, Content } = Layout;

export default function AppLoginedLayout(props) {
  return (
    <Layout style={{ minHeight: "100vh" }}>
      <Header>
        <AppMenu />
      </Header>
      <Layout>
        <Sider>
          <AppSider />
        </Sider>
        <Content>{props.children}</Content>
      </Layout>
    </Layout>
  );
}
