import React, { useState } from "react";
import { Breadcrumb, Form, Input, Button, message } from "antd";
import { changePassword } from "@/Api/User";
import AppLoginedLayout from "@/Layouts/AppLoginedLayout";

export default function ChangePassword() {
  const [oldPassword, setOldPassword] = useState({});
  const [newPassword, setNewPassword] = useState({});
  const [changePasswordForm] = Form.useForm();
  const rules = {
    old_password: [
      { required: true, message: "请输入旧密码" },
      { min: 6, message: "密码最短为 6 位" },
    ],
    new_password: [
      { required: true, message: "请输入新密码" },
      { min: 6, message: "密码最短为 6 位" },
    ],
    new_password_confirmation: [
      { required: true, message: "请输入再次输入新密码" },
    ],
  };
  const handleOnFinish = (values) => {
    changePassword(values)
      .then((response) => {
        const data = response.data;
        message.success("密码修改成功");
        changePasswordForm.resetFields();
        setOldPassword({});
        setNewPassword({});
      })
      .catch((error) => {
        const data = error.response.data.data;
        if (422 === error.response.status) {
          if (data.old_password) {
            setOldPassword({
              validateStatus: "error",
              errorMsg: data.old_password.shift(),
            });
          }
          if (data.new_password) {
            setNewPassword({
              validateStatus: "error",
              errorMsg: data.new_password.shift(),
            });
          }
        }
      });
  };
  return (
    <AppLoginedLayout>
      <Breadcrumb>
        <Breadcrumb.Item>首页</Breadcrumb.Item>
        <Breadcrumb.Item>个人中心</Breadcrumb.Item>
        <Breadcrumb.Item>修改密码</Breadcrumb.Item>
      </Breadcrumb>
      <Form form={changePasswordForm} onFinish={handleOnFinish}>
        <Form.Item
          label="旧密码"
          name="old_password"
          rules={rules.old_password}
          validateStatus={oldPassword.validateStatus}
          help={oldPassword.errorMsg}
        >
          <Input.Password placeholder="******" />
        </Form.Item>
        <Form.Item
          label="新密码"
          name="new_password"
          rules={rules.new_password}
          validateStatus={newPassword.validateStatus}
          help={newPassword.errorMsg}
        >
          <Input.Password placeholder="******" />
        </Form.Item>
        <Form.Item
          label="确认密码"
          name="new_password_confirmation"
          rules={rules.new_password_confirmation}
        >
          <Input.Password placeholder="******" />
        </Form.Item>
        <Button type="primary" htmlType="submit">
          修改密码
        </Button>
      </Form>
    </AppLoginedLayout>
  );
}
