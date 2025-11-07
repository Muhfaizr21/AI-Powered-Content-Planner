import React from "react";
import { Link } from "@inertiajs/react";

export default function Show({ content }) {
  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white p-8">
      <div className="max-w-3xl mx-auto bg-gray-900/70 rounded-2xl shadow-2xl p-8 border border-gray-700">
        <h1 className="text-3xl font-bold mb-4">{content.theme}</h1>
        <pre className="whitespace-pre-wrap text-gray-300 mb-6">
          {content.ideas}
        </pre>
        <Link
          href="/dashboard"
          className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
          🔙 Back to Dashboard
        </Link>
      </div>
    </div>
  );
}
