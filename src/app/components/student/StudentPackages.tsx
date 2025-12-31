import { Package, Clock, CheckCircle } from 'lucide-react';

interface StudentPackage {
  id: number;
  name: string;
  subject: string;
  totalSessions: number;
  usedSessions: number;
  purchaseDate: string;
  startDate: string;
  endDate: string;
  status: 'active' | 'expired';
  price: number;
}

export function StudentPackages() {
  const packages: StudentPackage[] = [
    { id: 1, name: 'Paket Web Development Basic', subject: 'Web Development', totalSessions: 12, usedSessions: 8, purchaseDate: '2024-01-10', startDate: '2024-01-10', endDate: '2024-03-10', status: 'active', price: 2400000 },
    { id: 2, name: 'Paket Mobile App Development', subject: 'Mobile Development', totalSessions: 16, usedSessions: 6, purchaseDate: '2024-01-05', startDate: '2024-01-05', endDate: '2024-03-20', status: 'active', price: 3600000 },
    { id: 3, name: 'Paket UI/UX Design', subject: 'Design', totalSessions: 10, usedSessions: 10, purchaseDate: '2023-12-01', startDate: '2023-12-01', endDate: '2024-01-20', status: 'expired', price: 2000000 },
  ];

  const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(amount);
  };

  const activePackages = packages.filter(p => p.status === 'active');
  const expiredPackages = packages.filter(p => p.status === 'expired');

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h2 className="text-2xl font-bold text-gray-800">Paket Saya</h2>
        <p className="text-sm text-gray-600 mt-1">Daftar paket yang telah dibeli</p>
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
              <CheckCircle size={20} className="text-green-600" />
            </div>
            <p className="text-sm text-gray-600">Paket Aktif</p>
          </div>
          <p className="text-3xl font-bold text-green-600">{activePackages.length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center gap-3 mb-2">
            <div className="p-2 bg-gray-100 rounded-lg">
              <Clock size={20} className="text-gray-600" />
            </div>
            <p className="text-sm text-gray-600">Paket Kedaluwarsa</p>
          </div>
          <p className="text-3xl font-bold text-gray-600">{expiredPackages.length}</p>
        </div>
      </div>

      {/* Active Packages */}
      {activePackages.length > 0 && (
        <div>
          <h3 className="text-lg font-semibold text-gray-800 mb-4">Paket Aktif</h3>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {activePackages.map((pkg) => {
              const progressPercentage = (pkg.usedSessions / pkg.totalSessions) * 100;
              const daysLeft = Math.ceil((new Date(pkg.endDate).getTime() - new Date().getTime()) / (1000 * 60 * 60 * 24));
              const isExpiringSoon = daysLeft <= 7;

              return (
                <div key={pkg.id} className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                  <div className={`h-2 ${isExpiringSoon ? 'bg-orange-500' : 'bg-green-500'}`}></div>
                  <div className="p-6">
                    <div className="flex items-start justify-between mb-4">
                      <div>
                        <h4 className="font-semibold text-gray-800 mb-1">{pkg.name}</h4>
                        <span className="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">
                          {pkg.subject}
                        </span>
                      </div>
                      <span className="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                        Aktif
                      </span>
                    </div>

                    {isExpiringSoon && (
                      <div className="mb-4 p-3 bg-orange-50 border border-orange-200 rounded-lg">
                        <p className="text-sm text-orange-700 font-medium">
                          ⚠️ Paket akan kedaluwarsa dalam {daysLeft} hari
                        </p>
                      </div>
                    )}

                    <div className="space-y-3 mb-4">
                      <div className="flex items-center justify-between text-sm">
                        <span className="text-gray-600">Sisa Pertemuan</span>
                        <span className="font-semibold text-gray-800">
                          {pkg.totalSessions - pkg.usedSessions} / {pkg.totalSessions}
                        </span>
                      </div>
                      <div className="w-full bg-gray-200 rounded-full h-2">
                        <div 
                          className={`h-2 rounded-full ${isExpiringSoon ? 'bg-orange-500' : 'bg-blue-500'}`}
                          style={{ width: `${progressPercentage}%` }}
                        ></div>
                      </div>
                    </div>

                    <div className="space-y-2 text-sm text-gray-600 border-t border-gray-100 pt-4">
                      <div className="flex justify-between">
                        <span>Tanggal Beli</span>
                        <span className="font-medium text-gray-800">{pkg.purchaseDate}</span>
                      </div>
                      <div className="flex justify-between">
                        <span>Masa Aktif</span>
                        <span className="font-medium text-gray-800">{pkg.startDate} - {pkg.endDate}</span>
                      </div>
                      <div className="flex justify-between">
                        <span>Harga</span>
                        <span className="font-medium text-blue-600">{formatCurrency(pkg.price)}</span>
                      </div>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      )}

      {/* Expired Packages */}
      {expiredPackages.length > 0 && (
        <div>
          <h3 className="text-lg font-semibold text-gray-800 mb-4">Paket Kedaluwarsa</h3>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {expiredPackages.map((pkg) => (
              <div key={pkg.id} className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden opacity-75">
                <div className="h-2 bg-gray-400"></div>
                <div className="p-6">
                  <div className="flex items-start justify-between mb-4">
                    <div>
                      <h4 className="font-semibold text-gray-800 mb-1">{pkg.name}</h4>
                      <span className="inline-block px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded">
                        {pkg.subject}
                      </span>
                    </div>
                    <span className="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                      Kedaluwarsa
                    </span>
                  </div>

                  <div className="space-y-3 mb-4">
                    <div className="flex items-center justify-between text-sm">
                      <span className="text-gray-600">Pertemuan Selesai</span>
                      <span className="font-semibold text-gray-800">
                        {pkg.usedSessions} / {pkg.totalSessions}
                      </span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-2">
                      <div 
                        className="bg-gray-500 h-2 rounded-full"
                        style={{ width: `${(pkg.usedSessions / pkg.totalSessions) * 100}%` }}
                      ></div>
                    </div>
                  </div>

                  <div className="space-y-2 text-sm text-gray-600 border-t border-gray-100 pt-4">
                    <div className="flex justify-between">
                      <span>Masa Aktif</span>
                      <span className="font-medium text-gray-800">{pkg.startDate} - {pkg.endDate}</span>
                    </div>
                    <div className="flex justify-between">
                      <span>Harga</span>
                      <span className="font-medium text-gray-800">{formatCurrency(pkg.price)}</span>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}
