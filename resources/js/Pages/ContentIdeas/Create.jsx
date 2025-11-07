import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";

export default function Create() {
  const [theme, setTheme] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    Inertia.post("/content", { theme });
  };

  return (
    <div style={{ padding: "2rem" }}>
      <h1 style={{ fontSize: "1.5rem", fontWeight: "bold" }}>Generate AI Content Ideas</h1>
      <form onSubmit={handleSubmit} style={{ marginTop: "1rem" }}>
        <input
          type="text"
          value={theme}
          onChange={(e) => setTheme(e.target.value)}
          placeholder="Enter theme..."
          style={{ padding: "0.5rem", width: "100%", marginBottom: "1rem" }}
        />
        <button
          type="submit"
          style={{
            backgroundColor: "#4F46E5",
            color: "white",
            padding: "0.5rem 1rem",
            borderRadius: "0.25rem",
          }}
        >
          Generate Ideas
        </button>
      </form>
    </div>
  );
}
