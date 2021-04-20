import React, { useState } from "react";
import { PageHeader, Breadcrumb, Form, Input, Button } from "antd";
import { InertiaLink } from "@inertiajs/inertia-react";
import { destroy } from "@/Api/User";
import AppLoginedLayout from "@/Layouts/AppLoginedLayout";

export default function Destroy() {
  const [errors, setErrors] = useState({ password: {} });
  const rules = {
    password: [
      { required: true, message: "请输入密码，确认删除本账号" },
      { min: 6, message: "最短为 6 位密码" },
    ],
  };
  const handleOnFinish = (values) => {
    destroy(values)
      .then((response) => {
        const data = response.data;
        window.localStorage.removeItem("access_token");
        window.location.href = "/";
      })
      .catch((error) => {
        console.log(error.response);
        const status = error.response.status;
        const data = error.response.data;
        if (422 === status) {
          if (data.data.password) {
            console.log(data);
            setErrors({
              password: {
                validateStatus: "error",
                errorMsg: data.data.password.shift(),
              },
            });
          }
        }
      });
  };
  const handleBreadcrumbRender = () => {
    return (
      <Breadcrumb>
        <Breadcrumb.Item>
          <InertiaLink href="/">首页</InertiaLink>
        </Breadcrumb.Item>
        <Breadcrumb.Item>
          <InertiaLink href="/profile">个人中心</InertiaLink>
        </Breadcrumb.Item>
        <Breadcrumb.Item>删除账户</Breadcrumb.Item>
      </Breadcrumb>
    );
  };
  return (
    <AppLoginedLayout>
      <PageHeader breadcrumbRender={handleBreadcrumbRender} />
      <Form onFinish={handleOnFinish}>
        <Form.Item
          label="密码"
          name="password"
          rules={rules.password}
          validateStatus={errors.password.validateStatus}
          help={errors.password.errorMsg}
        >
          <Input.Password placeholder="请输入密码" />
        </Form.Item>
        <Button type="primary" htmlType="submit" danger>
          确认删除本账号！
        </Button>
      </Form>
    </AppLoginedLayout>
  );
}
