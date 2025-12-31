import { useState } from 'react';
import { Plus, Edit, Package } from 'lucide-react';

interface PackageType {
  id: number;
  name: string;
  subject: string;
  sessions: number;
  validityDays: number;
  price: number;
  description: string;
  isActive: boolean;
}

export function ManagePackages() {
  const [showAddModal, setShowAddModal] = useState(false);

  const [packages] = useState<PackageType[]>([
    { id: 1, name: 'Paket Web Development Basic', subject: 'Web Development', sessions: 12, validityDays: 60, price: 2400000, description: 'HTML, CSS, JavaScript dasar', isActive: true },
    { id: 2, name: 'Paket Web Development Advanced', subject: 'Web Development', sessions: 20, validityDays: 90, price: 4500000, description: 'React, Node.js, Database', isActive: true },
    { id: 3, name: 'Paket Mobile App Development', subject: 'Mobile Development', sessions: 16, validityDays: 75, price: 3600000, description: 'React Native / Flutter', isActive: true },
    { id: 4, name: 'Paket Data Science', subject: 'Data Science', sessions: 15, validityDays: 70, price: 3500000, description: 'Python, Pandas, Machine Learning', isActive: true },
    { id: 5, name: 'Paket UI/UX Design', subject: 'Design', sessions: 10, validityDays: 50, price: 2000000, description: 'Figma, User Research, Prototyping', isActive: false },
  ]);

  const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(amount);
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-gray-800">Kelola Paket Les</h2>
          <p className="text-sm text-gray-600 mt-1">Kelola paket pembelajaran dan harga</p>
        </div>
        <button 
          onClick={() => setShowAddModal(true)}
          className="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
        >
          <Plus size={20} />
          Tambah Paket
        </button>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center gap-3 mb-2">
            <div className="p-2 bg-blue-100 rounded-lg">
              <Package size={20} className="text-blue-600" />
            </div>
            <p className="text-sm text-gray-600">Total Paket</p>
          </div>
          <p className="text-3xl font-bold text-gray-800">{packages.length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center gap-3 mb-2">
            <div className="p-2 bg-green-100 rounded-lg">
              <Package size={20} className="text-green-600" />
            </div>
            <p className="text-sm text-gray-600">Paket Aktif</p>
          </div>
          <p className="text-3xl font-bold text-gray-800">{packages.filter(p => p.isActive).length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center gap-3 mb-2">
            <div className="p-2 bg-gray-100 rounded-lg">
              <Package size={20} className="text-gray-600" />
            </div>
            <p className="text-sm text-gray-600">Paket Nonaktif</p>
          </div>
          <p className="text-3xl font-bold text-gray-800">{packages.filter(p => !p.isActive).length}</p>
        </div>
      </div>

      {/* Packages Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {packages.map((pkg) => (
          <div key={pkg.id} className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div className={`h-2 ${pkg.isActive ? 'bg-green-500' : 'bg-gray-400'}`}></div>
            <div className="p-6">
              <div className="flex items-start justify-between mb-4">
                <div>
                  <h3 className="font-semibold text-gray-800 mb-1">{pkg.name}</h3>
                  <span className="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">
                    {pkg.subject}
                  </span>
                </div>
                <button className="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                  <Edit size={18} />
                </button>
              </div>
              
              <p className="text-sm text-gray-600 mb-4">{pkg.description}</p>
              
              <div className="space-y-2 mb-4">
                <div className="flex items-center justify-between text-sm">
                  <span className="text-gray-600">Jumlah Pertemuan</span>
                  <span className="font-medium text-gray-800">{pkg.sessions}x</span>
                </div>
                <div className="flex items-center justify-between text-sm">
                  <span className="text-gray-600">Masa Aktif</span>
                  <span className="font-medium text-gray-800">{pkg.validityDays} hari</span>
                </div>
              </div>
              
              <div className="pt-4 border-t border-gray-200">
                <div className="flex items-center justify-between">
                  <span className="text-sm text-gray-600">Harga</span>
                  <span className="text-xl font-bold text-blue-600">{formatCurrency(pkg.price)}</span>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Add Modal */}
      {showAddModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
          <div className="bg-white rounded-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <h3 className="text-xl font-bold text-gray-800 mb-4">Tambah Paket Baru</h3>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="md:col-span-2">
                <label className="block text-sm font-medium text-gray-700 mb-1">Nama Paket</label>
                <input type="text" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                <select className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                  <option>Web Development</option>
                  <option>Mobile Development</option>
                  <option>Data Science</option>
                  <option>Design</option>
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Jumlah Pertemuan</label>
                <input type="number" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Masa Aktif (hari)</label>
                <input type="number" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
              </div>
              <div className="md:col-span-2">
                <label className="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea rows={3} className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
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
