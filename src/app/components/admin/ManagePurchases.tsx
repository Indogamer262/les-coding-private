import { useState } from 'react';
import { Plus, Eye } from 'lucide-react';

interface Purchase {
  id: number;
  studentName: string;
  packageName: string;
  purchaseDate: string;
  startDate: string;
  endDate: string;
  totalSessions: number;
  usedSessions: number;
  price: number;
  status: 'active' | 'expired';
}

export function ManagePurchases() {
  const [showAddModal, setShowAddModal] = useState(false);

  const [purchases] = useState<Purchase[]>([
    { id: 1, studentName: 'Ahmad Fauzi', packageName: 'Paket Web Development Basic', purchaseDate: '2024-01-15', startDate: '2024-01-15', endDate: '2024-03-15', totalSessions: 12, usedSessions: 8, price: 2400000, status: 'active' },
    { id: 2, studentName: 'Siti Nurhaliza', packageName: 'Paket Mobile App Development', purchaseDate: '2024-01-14', startDate: '2024-01-14', endDate: '2024-03-28', totalSessions: 16, usedSessions: 10, price: 3600000, status: 'active' },
    { id: 3, studentName: 'Budi Santoso', packageName: 'Paket Data Science', purchaseDate: '2024-01-10', startDate: '2024-01-10', endDate: '2024-03-20', totalSessions: 15, usedSessions: 15, price: 3500000, status: 'expired' },
    { id: 4, studentName: 'Dewi Lestari', packageName: 'Paket Web Development Advanced', purchaseDate: '2024-01-12', startDate: '2024-01-12', endDate: '2024-04-11', totalSessions: 20, usedSessions: 5, price: 4500000, status: 'active' },
  ]);

  const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(amount);
  };

  const getProgressColor = (used: number, total: number) => {
    const percentage = (used / total) * 100;
    if (percentage >= 80) return 'bg-red-500';
    if (percentage >= 50) return 'bg-yellow-500';
    return 'bg-green-500';
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-gray-800">Kelola Pembelian</h2>
          <p className="text-sm text-gray-600 mt-1">Kelola pembelian paket dan status</p>
        </div>
        <button 
          onClick={() => setShowAddModal(true)}
          className="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
        >
          <Plus size={20} />
          Catat Pembelian
        </button>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Total Pembelian</p>
          <p className="text-3xl font-bold text-gray-800">{purchases.length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Paket Aktif</p>
          <p className="text-3xl font-bold text-green-600">{purchases.filter(p => p.status === 'active').length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Paket Kedaluwarsa</p>
          <p className="text-3xl font-bold text-red-600">{purchases.filter(p => p.status === 'expired').length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Total Pendapatan</p>
          <p className="text-2xl font-bold text-blue-600">
            {formatCurrency(purchases.reduce((sum, p) => sum + p.price, 0))}
          </p>
        </div>
      </div>

      {/* Purchases Table */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead className="bg-gray-50 border-b border-gray-200">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Murid</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Beli</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Masa Aktif</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {purchases.map((purchase) => {
                const progressPercentage = (purchase.usedSessions / purchase.totalSessions) * 100;
                return (
                  <tr key={purchase.id} className="hover:bg-gray-50 transition-colors">
                    <td className="px-6 py-4 whitespace-nowrap">
                      <span className="font-medium text-gray-800">{purchase.studentName}</span>
                    </td>
                    <td className="px-6 py-4">
                      <span className="text-sm text-gray-800">{purchase.packageName}</span>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                      {purchase.purchaseDate}
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                      {purchase.startDate} - {purchase.endDate}
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="space-y-1">
                        <div className="flex items-center justify-between text-xs text-gray-600">
                          <span>{purchase.usedSessions} / {purchase.totalSessions} sesi</span>
                          <span>{Math.round(progressPercentage)}%</span>
                        </div>
                        <div className="w-full bg-gray-200 rounded-full h-2">
                          <div 
                            className={`h-2 rounded-full ${getProgressColor(purchase.usedSessions, purchase.totalSessions)}`}
                            style={{ width: `${progressPercentage}%` }}
                          ></div>
                        </div>
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                      {formatCurrency(purchase.price)}
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                        purchase.status === 'active' 
                          ? 'bg-green-100 text-green-700' 
                          : 'bg-red-100 text-red-700'
                      }`}>
                        {purchase.status === 'active' ? 'Aktif' : 'Kedaluwarsa'}
                      </span>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <button className="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat Detail">
                        <Eye size={18} />
                      </button>
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      </div>

      {/* Add Modal */}
      {showAddModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
          <div className="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 className="text-xl font-bold text-gray-800 mb-4">Catat Pembelian Baru</h3>
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Murid</label>
                <select className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                  <option>Pilih Murid</option>
                  <option>Ahmad Fauzi</option>
                  <option>Siti Nurhaliza</option>
                  <option>Dewi Lestari</option>
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Paket</label>
                <select className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                  <option>Pilih Paket</option>
                  <option>Paket Web Development Basic</option>
                  <option>Paket Mobile App Development</option>
                  <option>Paket Data Science</option>
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Tanggal Pembelian</label>
                <input type="date" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="number" placeholder="2400000" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
              </div>
            </div>
            <div className="flex gap-2 mt-6">
              <button 
                onClick={() => setShowAddModal(false)}
                className="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
              >
                Batal
              </button>
              <button className="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Simpan
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
