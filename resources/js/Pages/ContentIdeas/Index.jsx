import React from 'react';
import { Link } from "@inertiajs/react";

export default function Index({ ideas }) {
  return (
    <div className="p-4">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-2xl font-bold">Content Ideas</h1>
        <Link href="/content/create" className="px-4 py-2 bg-indigo-600 text-white rounded">Buat</Link>
      </div>

      <div className="space-y-4">
        {ideas.data?.map(idea => (
          <div key={idea.id} className="p-4 border rounded">
            <h2 className="font-semibold">{idea.theme} — {idea.status}</h2>
            <p className="mt-2">{idea.idea}</p>
            <p className="text-sm text-gray-600 mt-1">{idea.caption}</p>
            <div className="mt-2">
              <Link href={`/content/${idea.id}`} className="text-indigo-600">Open</Link>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
