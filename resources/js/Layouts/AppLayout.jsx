import React from "react";
import { Layout } from "antd";

const { Header, Footer, Sider, Content } = Layout;

export default function AppLayout(props) {
  return (
    <Layout style={{ minHeight: "100vh" }}>
      <Header>Header</Header>
      <Content>{props.children}</Content>
      <Footer>Footer</Footer>
    </Layout>
  );
}
