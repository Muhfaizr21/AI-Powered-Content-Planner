import { Link } from '@inertiajs/react'

export default function Dashboard() {
  return (
    <div className="min-h-screen bg-gray-900 text-white flex flex-col items-center justify-center px-6">
      <div className="max-w-2xl w-full bg-gray-800 shadow-xl rounded-2xl p-8 text-center border border-gray-700">
        <h1 className="text-3xl font-bold mb-3 tracking-tight">
          ⚡ Dashboard
        </h1>
        <p className="text-gray-300 mb-8 text-lg">
          You're logged in — ready to create your next viral idea.
        </p>

        <div className="flex justify-center">
          <Link
            href="/contents"
            className="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200"
          >
            Go to Content Planner 🚀
          </Link>
        </div>
      </div>

      <footer className="mt-10 text-gray-500 text-sm">
        © {new Date().getFullYear()} FaizLabs — AI-Powered Innovation
      </footer>
    </div>
  )
}
