import React from 'react';
import { Link } from '@inertiajs/react';

export default function Index({ contents }) {
  return (
    <div className="p-8 max-w-3xl mx-auto">
      <div className="flex justify-between items-center mb-6">
        <h1 className="text-2xl font-bold">Content Ideas</h1>
        <Link href="/content/create" className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          + New
        </Link>
      </div>

      {contents.length === 0 ? (
        <p>No content ideas yet.</p>
      ) : (
        contents.map((item) => (
          <div key={item.id} className="border p-4 rounded mb-4">
            <h2 className="font-semibold">{item.theme}</h2>
            <pre className="whitespace-pre-wrap mt-2 text-sm">{item.ideas}</pre>
          </div>
        ))
      )}
    </div>
  );
}
