import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

export default function Create() {
  const [theme, setTheme] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    Inertia.post('/contents', { theme });
  };

  return (
    <div className="p-8 max-w-xl mx-auto">
      <h1 className="text-2xl font-bold mb-6">Generate AI Content Ideas</h1>

      <form onSubmit={handleSubmit} className="space-y-4">
        <input
          type="text"
          value={theme}
          onChange={(e) => setTheme(e.target.value)}
          placeholder="Masukkan tema konten, contoh: 'Tech Tips'"
          className="w-full border rounded p-2"
          required
        />

        <button
          type="submit"
          className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
          Generate
        </button>
      </form>
    </div>
  );
}
