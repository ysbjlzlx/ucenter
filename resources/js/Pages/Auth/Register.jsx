import React, { useState } from "react";
import { Form, Input, Button } from "antd";
import { register } from "@/Api/Auth";
import AppLayout from "@/Layouts/AppLayout";

export default function Register() {
  const [email, setEmail] = useState({});
  const [password, setPassword] = useState({});
  const [password_confirmation, setPasswordConfirmation] = useState({});
  const [registerForm] = Form.useForm();
  const handleConfirmPasswordValidation = (rule, value, callback) => {
    const password = registerForm.getFieldValue("password");
    if (password && value && password === value) {
      return Promise.resolve();
    }
    return Promise.reject("密码不一致");
  };

  const rules = {
    email: [
      { required: true, message: "请输入邮箱" },
      { type: "email", message: "请输入正确格式的邮箱" },
    ],
    password: [
      { required: true, message: "请输入密码" },
      { min: 6, message: "密码最短为 6 位" },
    ],
    password_confirmation: [
      { required: true, message: "请输入确认密码" },
      { validator: handleConfirmPasswordValidation },
    ],
  };
  const onFinish = (values) => {
    // console.log("Success:", values);
    register(values)
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
      <Form form={registerForm} name="basic" onFinish={onFinish}>
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
          <Input.Password placeholder="******" />
        </Form.Item>
        <Form.Item
          label="确认密码"
          name="password_confirmation"
          rules={rules.password_confirmation}
          validateStatus={password_confirmation.validateStatus}
          help={password_confirmation.errorMsg}
        >
          <Input.Password placeholder="******" />
        </Form.Item>
        <Button type="primary" htmlType="submit">
          注册
        </Button>
      </Form>
    </AppLayout>
  );
}
