import React from "react";
import { Layout } from "antd";
import AppMenu from "./AppMenu";

const { Header, Footer, Content } = Layout;

export default function AppLayout(props) {
  return (
    <Layout style={{ minHeight: "100vh" }}>
      <Header>
        <AppMenu />
      </Header>
      <Content>{props.children}</Content>
      <Footer>Footer</Footer>
    </Layout>
  );
}
