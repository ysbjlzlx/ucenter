import React, { useState, useEffect } from "react";
import { profile } from "@/Api/User";
import AppLoginedLayout from "@/Layouts/AppLoginedLayout";

export default function Profile() {
  useEffect(() => {
    profile().then((response) => {
      console.log(response);
    });
  });
  return (
    <AppLoginedLayout>
      <div>Profile</div>
    </AppLoginedLayout>
  );
}
