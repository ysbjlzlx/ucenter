import React, { useState, useEffect } from "react";
import { Form, PageHeader, Input, Button, Breadcrumb, message } from "antd";
import { InertiaLink } from "@inertiajs/inertia-react";
import { changeProfile, profile as fetchProfile } from "@/Api/User";
import AppLoginedLayout from "@/Layouts/AppLoginedLayout";

export default function ChangeProfile() {
  const [errors, setErrors] = useState({
    username: {},
    nickname: {},
  });
  const [profile, setProfile] = useState({});
  const [changeProfileForm] = Form.useForm();
  useEffect(() => {
    fetchProfile().then((response) => {
      const data = response.data;
      changeProfileForm.setFieldsValue(data.data);
      setProfile(data.data);
    });
  }, []);
  const rules = {
    username: [{ min: 6, message: "用户名最少为 6 位" }],
    nickname: [{ min: 3, message: "昵称最少为 3 位" }],
  };
  const handleOnFinish = (values) => {
    changeProfile(values)
      .then((response) => {
        const data = response.data;
        message.success("保存成功");
      })
      .catch((error) => {
        const data = error.response.data;
        if (422 === error.response.status) {
          if (data.data.username) {
            setErrors({
              username: {
                validateStatus: "error",
                errorMsg: data.data.username.shift(),
              },
              ...errors,
            });
          }
          if (data.data.nickanme) {
            setErrors({
              nickanme: {
                validateStatus: "error",
                errorMsg: data.data.nickanme.shift(),
              },
              ...errors,
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
        <Breadcrumb.Item>修改个人资料</Breadcrumb.Item>
      </Breadcrumb>
    );
  };
  return (
    <AppLoginedLayout>
      <PageHeader breadcrumbRender={handleBreadcrumbRender}></PageHeader>
      <Form form={changeProfileForm} onFinish={handleOnFinish}>
        <Form.Item
          label="用户名"
          name="username"
          initialValue={profile.username}
          rules={rules.username}
          validateStatus={errors.username.validateStatus}
          help={errors.username.errorMsg}
        >
          <Input placeholder="用户名" />
        </Form.Item>
        <Form.Item
          label="昵称"
          name="nickname"
          initialValue={profile.nickname}
          rules={rules.nickname}
          validateStatus={errors.nickname.validateStatus}
          help={errors.nickname.errorMsg}
        >
          <Input placeholder="昵称" />
        </Form.Item>
        <Button type="primary" htmlType="submit">
          保存
        </Button>
      </Form>
    </AppLoginedLayout>
  );
}
