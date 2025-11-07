import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";

export default function Create({ theme: initialTheme = "", ideas: initialIdeas = "" }) {
  const [theme, setTheme] = useState(initialTheme);
  const [ideas, setIdeas] = useState(initialIdeas);
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);

    const formData = new FormData();
    formData.append("theme", theme);

    try {
      const response = await fetch("/contents", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content },
        body: formData,
      });
      const data = await response.text(); // Laravel Inertia return HTML
      window.location.reload(); // auto refresh untuk render ide
    } catch (error) {
      console.error(error);
    } finally {
      setLoading(false);
    }
  };

  const renderIdeas = () => {
    if (!ideas) return null;
    const lines = ideas.split("\n").filter((line) => line.trim() !== "");
    return (
      <table className="w-full border mt-6">
        <thead>
          <tr className="bg-gray-200 text-left">
            <th className="p-2">#</th>
            <th className="p-2">Idea</th>
          </tr>
        </thead>
        <tbody>
          {lines.map((idea, index) => (
            <tr key={index} className="border-t">
              <td className="p-2 font-semibold">{index + 1}</td>
              <td className="p-2">{idea.replace(/^\d+\.\s*/, "")}</td>
            </tr>
          ))}
        </tbody>
      </table>
    );
  };

  return (
    <div className="p-8 max-w-2xl mx-auto">
      <h1 className="text-2xl font-bold mb-6 text-gray-800">🎯 Generate AI Content Ideas</h1>

      <form onSubmit={handleSubmit} className="space-y-4">
        <input
          type="text"
          value={theme}
          onChange={(e) => setTheme(e.target.value)}
          placeholder="Masukkan tema konten, contoh: Laravel Tips"
          className="w-full border rounded p-2 focus:ring focus:ring-indigo-200"
          required
        />

        <button
          type="submit"
          disabled={loading}
          className={`bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 ${
            loading && "opacity-50 cursor-not-allowed"
          }`}
        >
          {loading ? "Generating..." : "Generate Ideas"}
        </button>
      </form>

      {ideas && (
        <div className="mt-6">
          <h2 className="text-xl font-semibold mb-3 text-gray-700">✨ Generated Ideas</h2>
          {renderIdeas()}
        </div>
      )}
    </div>
  );
}
