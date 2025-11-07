import React from 'react';

export default function Index({ contents }) {
  return (
    <div className="p-6">
      <h1 className="text-2xl font-bold mb-4">All Content Ideas</h1>
      {contents.length === 0 ? (
        <p>No content ideas yet.</p>
      ) : (
        <ul className="space-y-4">
          {contents.map((item) => (
            <li key={item.id} className="p-4 bg-gray-100 rounded-md">
              <h2 className="font-semibold">{item.theme}</h2>
              <pre className="text-sm whitespace-pre-wrap">{item.ideas}</pre>
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}
