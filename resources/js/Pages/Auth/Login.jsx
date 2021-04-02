import React, { useState } from "react";
import { Form, Input, Button } from "antd";
import { login } from "@/Api/Auth";
import AppLayout from "@/Layouts/AppLayout";

const rules = {
  email: [{ required: true, message: "请输入邮箱" }],
  password: [
    { required: true, message: "请输入密码" },
    { min: 6, message: "密码最短为 6 位" },
  ],
};

export default function Welcome() {
  const [email, setEmail] = useState({});
  const [password, setPassword] = useState({});
  const onFinish = (values) => {
    // console.log("Success:", values);
    login(values)
      .then((response) => {
        console.log(response);
      })
      .catch((error) => {
        if (422 === error.response.status) {
          const data = error.response.data.data;
          if (data.email) {
            setEmail({ validateStatus: "error", errorMsg: data.email.shift() });
          }
          if (data.password) {
            setPassword({
              validateStatus: "error",
              errorMsg: data.password.shift(),
            });
          }
        } else {
          console.log(error.response);
        }
      });
  };
  return (
    <AppLayout>
      <Form name="basic" onFinish={onFinish}>
        <Form.Item
          label="邮箱"
          name="email"
          rules={rules.email}
          validateStatus={email.validateStatus}
          help={email.errorMsg}
        >
          <Input type="email" />
        </Form.Item>
        <Form.Item
          label="密码"
          name="password"
          rules={rules.password}
          validateStatus={password.validateStatus}
          help={password.errorMsg}
        >
          <Input type="password" placeholder="******" />
        </Form.Item>
        <Button type="primary" htmlType="submit">
          登录
        </Button>
      </Form>
    </AppLayout>
  );
}
