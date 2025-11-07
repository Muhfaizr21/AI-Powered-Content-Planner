import React from 'react';
import { router } from "@inertiajs/react";
import { useForm } from "@inertiajs/react";


export default function Create() {
  const { data, setData, post, processing, errors } = useForm({
    theme: '',
    idea: '',
    caption: '',
    platform: '',
  });

  async function handleGenerate(e) {
    e.preventDefault();
    // call AI endpoint
    const res = await fetch('/ai/generate', {
      method: 'POST',
      headers: {'Content-Type':'application/json','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
      body: JSON.stringify({ theme: data.theme, count: 5 })
    });
    const json = await res.json();
    if (json.ideas) {
      // take first idea as default
      const pick = json.ideas[0];
      setData('idea', pick.title || '');
      setData('caption', pick.caption || '');
      setData('platform', pick.platform || '');
      // optionally store ideas in state for show list
    }
  }

  function submit(e) {
    e.preventDefault();
    post('/content');
  }

  return (
    <div className="p-4">
      <h1 className="text-2xl font-bold mb-4">Buat Ide Konten</h1>

      <form onSubmit={submit} className="space-y-4">
        <div>
          <label>Theme</label>
          <input value={data.theme} onChange={e => setData('theme', e.target.value)} className="w-full p-2 border rounded" />
        </div>

        <div className="flex gap-2">
          <button onClick={handleGenerate} className="px-4 py-2 bg-indigo-600 text-white rounded">Generate AI</button>
        </div>

        <div>
          <label>Idea</label>
          <textarea value={data.idea} onChange={e=>setData('idea', e.target.value)} className="w-full p-2 border rounded" />
        </div>

        <div>
          <label>Caption</label>
          <textarea value={data.caption} onChange={e=>setData('caption', e.target.value)} className="w-full p-2 border rounded" />
        </div>

        <div>
          <label>Platform</label>
          <select value={data.platform} onChange={e=>setData('platform', e.target.value)} className="w-full p-2 border rounded">
            <option value="">-- pilih --</option>
            <option value="tiktok">TikTok</option>
            <option value="instagram">Instagram</option>
            <option value="x">X (Twitter)</option>
            <option value="youtube">YouTube</option>
          </select>
        </div>

        <div>
          <button type="submit" disabled={processing} className="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
        </div>
      </form>
    </div>
  );
}
