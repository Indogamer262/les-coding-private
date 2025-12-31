import { Users, Package, ShoppingCart, Calendar, TrendingUp, AlertCircle } from 'lucide-react';

export function AdminDashboard() {
  const stats = [
    { label: 'Total Murid', value: '156', icon: Users, color: 'bg-blue-500', change: '+12%' },
    { label: 'Total Pengajar', value: '24', icon: Users, color: 'bg-green-500', change: '+3%' },
    { label: 'Paket Aktif', value: '89', icon: Package, color: 'bg-purple-500', change: '+8%' },
    { label: 'Pembelian Bulan Ini', value: '34', icon: ShoppingCart, color: 'bg-orange-500', change: '+15%' },
  ];

  const recentPurchases = [
    { id: 1, student: 'Ahmad Fauzi', package: 'Paket Web Development', date: '2024-01-15', status: 'Aktif' },
    { id: 2, student: 'Siti Nurhaliza', package: 'Paket Mobile App', date: '2024-01-14', status: 'Aktif' },
    { id: 3, student: 'Budi Santoso', package: 'Paket Data Science', date: '2024-01-13', status: 'Aktif' },
    { id: 4, student: 'Dewi Lestari', package: 'Paket Backend Development', date: '2024-01-12', status: 'Aktif' },
  ];

  const expiringPackages = [
    { id: 1, student: 'Rahman Hidayat', package: 'Paket Web Development', daysLeft: 5, sessions: 2 },
    { id: 2, student: 'Lisa Wijaya', package: 'Paket Mobile App', daysLeft: 3, sessions: 1 },
    { id: 3, student: 'Andi Setiawan', package: 'Paket UI/UX Design', daysLeft: 7, sessions: 3 },
  ];

  return (
    <div className="space-y-6">
      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {stats.map((stat, index) => {
          const Icon = stat.icon;
          return (
            <div key={index} className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
              <div className="flex items-center justify-between">
                <div>
                  <p className="text-sm text-gray-600 mb-1">{stat.label}</p>
                  <p className="text-3xl font-bold text-gray-800">{stat.value}</p>
                  <div className="flex items-center gap-1 mt-2">
                    <TrendingUp size={16} className="text-green-500" />
                    <span className="text-sm text-green-500 font-medium">{stat.change}</span>
                  </div>
                </div>
                <div className={`${stat.color} p-3 rounded-lg`}>
                  <Icon size={24} className="text-white" />
                </div>
              </div>
            </div>
          );
        })}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Recent Purchases */}
        <div className="bg-white rounded-lg shadow-sm border border-gray-100">
          <div className="p-6 border-b border-gray-100">
            <h3 className="text-lg font-semibold text-gray-800">Pembelian Terbaru</h3>
          </div>
          <div className="p-6">
            <div className="space-y-4">
              {recentPurchases.map((purchase) => (
                <div key={purchase.id} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                  <div className="flex-1">
                    <p className="font-medium text-gray-800">{purchase.student}</p>
                    <p className="text-sm text-gray-600">{purchase.package}</p>
                    <p className="text-xs text-gray-500 mt-1">{purchase.date}</p>
                  </div>
                  <span className="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                    {purchase.status}
                  </span>
                </div>
              ))}
            </div>
          </div>
        </div>

        {/* Expiring Packages Alert */}
        <div className="bg-white rounded-lg shadow-sm border border-gray-100">
          <div className="p-6 border-b border-gray-100 flex items-center gap-2">
            <AlertCircle size={20} className="text-orange-500" />
            <h3 className="text-lg font-semibold text-gray-800">Paket Mendekati Kedaluwarsa</h3>
          </div>
          <div className="p-6">
            <div className="space-y-4">
              {expiringPackages.map((pkg) => (
                <div key={pkg.id} className="p-4 bg-orange-50 border border-orange-200 rounded-lg">
                  <div className="flex items-start justify-between mb-2">
                    <div className="flex-1">
                      <p className="font-medium text-gray-800">{pkg.student}</p>
                      <p className="text-sm text-gray-600">{pkg.package}</p>
                    </div>
                    <span className="px-2 py-1 bg-orange-500 text-white text-xs font-medium rounded">
                      {pkg.daysLeft} hari
                    </span>
                  </div>
                  <p className="text-xs text-gray-600">Sisa {pkg.sessions} pertemuan</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>

      {/* Quick Stats */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
        <h3 className="text-lg font-semibold text-gray-800 mb-4">Statistik Pertemuan Hari Ini</h3>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div className="p-4 bg-blue-50 rounded-lg">
            <p className="text-sm text-gray-600 mb-1">Total Jadwal</p>
            <p className="text-2xl font-bold text-blue-600">15</p>
          </div>
          <div className="p-4 bg-green-50 rounded-lg">
            <p className="text-sm text-gray-600 mb-1">Selesai</p>
            <p className="text-2xl font-bold text-green-600">8</p>
          </div>
          <div className="p-4 bg-gray-50 rounded-lg">
            <p className="text-sm text-gray-600 mb-1">Belum Dimulai</p>
            <p className="text-2xl font-bold text-gray-600">7</p>
          </div>
        </div>
      </div>
    </div>
  );
}
