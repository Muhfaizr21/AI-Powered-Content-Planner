import { Link } from "@inertiajs/react";

export default function Dashboard() {
  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white flex flex-col items-center justify-center px-6 relative overflow-hidden">
      {/* Efek background subtle */}
      <div className="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,rgba(59,130,246,0.2),transparent_70%)]"></div>

      {/* Kartu utama */}
      <div className="relative max-w-2xl w-full bg-gray-900/80 backdrop-blur-md border border-gray-700 shadow-2xl rounded-3xl p-10 text-center">
        <h1 className="text-4xl font-extrabold mb-3 tracking-tight bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
          🚀 FaizLabs Dashboard
        </h1>
        <p className="text-gray-400 mb-8 text-lg">
          You’re logged in, <span className="text-blue-400 font-semibold">Tuan Faiz</span> —
          time to craft your next viral masterpiece.
        </p>

        <div className="flex justify-center">
          <Link
            href="/contents/create"
            className="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 hover:scale-[1.03] active:scale-[0.98] shadow-lg shadow-blue-600/30"
          >
            Open Content Planner ⚡
          </Link>
        </div>
      </div>

      {/* Footer */}
      <footer className="mt-12 text-gray-500 text-sm text-center">
        © {new Date().getFullYear()} <span className="text-blue-400 font-semibold">FaizLabs</span>
        — AI-Powered Innovation for the Next Generation
      </footer>
    </div>
  );
}
