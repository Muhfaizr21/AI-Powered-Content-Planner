import React from "react";
import { Link } from "@inertiajs/react";

export default function Show({ content }) {
  // Pisahkan ide-ide jadi list biar rapi
  const ideasArray = content.ideas
    ? content.ideas
        .split(/\n|\d+\.\s|[-•]\s/) // Pecah berdasarkan pola umum (angka/bullet)
        .map((idea) => idea.trim())
        .filter((idea) => idea.length > 0)
    : [];

  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white flex items-center justify-center px-4 py-10">
      <div className="w-full max-w-3xl bg-gray-900/70 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-gray-700">
        <h1 className="text-3xl font-bold mb-2 text-center text-blue-400">
          ✨ {content.theme}
        </h1>
        <p className="text-gray-400 mb-8 text-center text-sm">
          Hasil ide konten yang dihasilkan AI khusus untuk tema ini
        </p>

        {ideasArray.length > 0 ? (
          <div className="space-y-4 mb-8">
            {ideasArray.map((idea, index) => (
              <div
                key={index}
                className="p-4 bg-gray-800/60 border border-gray-700 rounded-lg hover:bg-gray-800 transition"
              >
                <h2 className="font-semibold text-lg mb-1 text-blue-300">
                  💡 Idea #{index + 1}
                </h2>
                <p className="text-gray-300 leading-relaxed">{idea}</p>
              </div>
            ))}
          </div>
        ) : (
          <p className="text-gray-400 italic text-center mb-8">
            Tidak ada ide yang dihasilkan.
          </p>
        )}

        <div className="flex justify-center">
          <Link
            href="/contents/create"
            className="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 active:scale-95 transition-all"
          >
            🔁 Generate Again
          </Link>
        </div>
      </div>
    </div>
  );
}
