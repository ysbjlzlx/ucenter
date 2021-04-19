import React from "react";
import { PageHeader, Breadcrumb } from "antd";
import { InertiaLink } from "@inertiajs/inertia-react";
import AppLoginedLayout from "@/Layouts/AppLoginedLayout";

export default function Destroy() {
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
    </AppLoginedLayout>
  );
}
