import React, { useState, useEffect } from "react";
import { InertiaLink } from "@inertiajs/inertia-react";
import { Breadcrumb, message, Upload, PageHeader } from "antd";
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
      message.success("头像修改成功");
      console.log(response);
      const data = response.data;
      setAvatar(data.data.avatar);
    });
  };

  const uploadButton = (
    <div>
      {loading ? <LoadingOutlined /> : <PlusOutlined />}
      <div style={{ marginTop: 8 }}>上传</div>
    </div>
  );

  const breadcrumb = () => {
    return (
      <Breadcrumb>
        <Breadcrumb.Item>
          <InertiaLink href="/">首页</InertiaLink>
        </Breadcrumb.Item>
        <Breadcrumb.Item>
          <InertiaLink href="/home/account">个人中心</InertiaLink>
        </Breadcrumb.Item>
        <Breadcrumb.Item>
          <InertiaLink href="">修改头像</InertiaLink>
        </Breadcrumb.Item>
      </Breadcrumb>
    );
  };

  return (
    <AppLoginedLayout>
      <PageHeader breadcrumbRender={breadcrumb} />
      <div style={{ marginLeft: "24px" }}>
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
      </div>
    </AppLoginedLayout>
  );
}
