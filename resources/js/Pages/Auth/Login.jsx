import React from "react";
import { Form, Input, Button } from "antd";
import AppLayout from "@/Layouts/AppLayout";

const rules = {
  email: [{ required: true, message: "请输入邮箱" }],
  password: [{ required: true, message: "请输入密码" }],
};

export default function Welcome() {
  const onFinish = (values) => {
    console.log("Success:", values);
  };
  return (
    <AppLayout>
      <Form name="basic" onFinish={onFinish}>
        <Form.Item label="邮箱" name="email" rules={rules.email}>
          <Input type="email" />
        </Form.Item>
        <Form.Item label="密码" name="password" rules={rules.password}>
          <Input type="password" placeholder="******" />
        </Form.Item>
        <Button type="primary" htmlType="submit">
          登录
        </Button>
      </Form>
    </AppLayout>
  );
}
