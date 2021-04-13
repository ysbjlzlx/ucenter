import React, { useState, useEffect } from "react";
import { profile } from "@/Api/User";
import AppLayout from "@/Layouts/AppLayout";

export default function Profile() {
  useEffect(() => {
    profile().then((response) => {
      console.log(response);
    });
  });
  return (
    <AppLayout>
      <div>Profile</div>
    </AppLayout>
  );
}
