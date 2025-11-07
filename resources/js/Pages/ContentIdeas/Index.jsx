import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";

export default function Create() {
  const [theme, setTheme] = useState("");
  const [loading, setLoading] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    setLoading(true);
    Inertia.post("/contents", { theme }, {
      onFinish: () => setLoading(false),
    });
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white flex items-center justify-center px-4">
      <div className="w-full max-w-xl bg-gray-900/70 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-gray-700">
        <h1 className="text-3xl font-bold mb-3 text-center">
          ⚡ AI Content Planner
        </h1>
        <p className="text-gray-400 mb-6 text-center text-sm">
          Masukkan tema — biarkan AI bantu kamu rancang ide konten brilian.
        </p>

        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <input
              type="text"
              value={theme}
              onChange={(e) => setTheme(e.target.value)}
              placeholder="Contoh: 'Laravel Tips untuk Developer Modern'"
              className="w-full bg-gray-800 text-white border border-gray-700 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-500"
              required
            />
          </div>

          <button
            type="submit"
            disabled={loading}
            className={`w-full py-3 rounded-lg font-semibold transition-all ${
              loading
                ? "bg-blue-800 cursor-not-allowed"
                : "bg-blue-600 hover:bg-blue-700 active:scale-[0.98]"
            }`}
          >
            {loading ? "Generating..." : "🚀 Generate Ideas"}
          </button>
        </form>
      </div>
    </div>
  );
}
