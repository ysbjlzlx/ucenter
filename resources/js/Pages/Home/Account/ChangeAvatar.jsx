import React, { useState, useEffect } from "react";
import { Breadcrumb, Form, Input, Button, message, Upload } from "antd";
import { LoadingOutlined, PlusOutlined } from "@ant-design/icons";
import { changeAvatar, profile } from "@/Api/User";
import AppLoginedLayout from "@/Layouts/AppLoginedLayout";

export default function ChangeAvatar() {
  const [avatar, setAvatar] = useState();
  const [loading, setLoading] = useState(false);
  useEffect(() => {
    profile().then((response) => {
      const data = response.data.data;
      setAvatar(data.avatar);
    });
  }, []);
  const handleChange = (info) => {
    console.log(info);
    const formData = new FormData();
    formData.append("avatar", info.file);
    changeAvatar(formData).then((response) => {
      console.log(response);
    });
  };

  const uploadButton = (
    <div>
      {loading ? <LoadingOutlined /> : <PlusOutlined />}
      <div style={{ marginTop: 8 }}>上传</div>
    </div>
  );

  return (
    <AppLoginedLayout>
      <Breadcrumb>
        <Breadcrumb.Item>首页</Breadcrumb.Item>
        <Breadcrumb.Item>个人中心</Breadcrumb.Item>
        <Breadcrumb.Item>修改头像</Breadcrumb.Item>
      </Breadcrumb>
      <Upload
        name="avatar"
        listType="picture-card"
        showUploadList={false}
        customRequest={handleChange}
      >
        {avatar ? (
          <img src={avatar} alt="avatar" style={{ width: "100%" }} />
        ) : (
          uploadButton
        )}
      </Upload>
    </AppLoginedLayout>
  );
}
