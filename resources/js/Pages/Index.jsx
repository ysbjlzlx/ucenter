import React from "react";
import { Button } from "antd";
import AppLayout from "@/Layouts/AppLayout";

export default function Welcome() {
  return (
    <AppLayout>
      <h1>Welcome</h1>
      <Button>ha</Button>
      <p>Hello , welcome to your first Inertia app!</p>
    </AppLayout>
  );
}
