import { Package, Calendar, TrendingUp, AlertCircle } from 'lucide-react';

export function StudentDashboard() {
  const studentData = {
    name: 'John Doe',
    totalActivePackages: 2,
    totalSessions: 32,
    usedSessions: 18,
    upcomingSchedules: 3,
  };

  const activePackages = [
    { id: 1, name: 'Paket Web Development Basic', sessionsLeft: 4, totalSessions: 12, expiresIn: 15 },
    { id: 2, name: 'Paket Mobile App Development', sessionsLeft: 10, totalSessions: 16, expiresIn: 45 },
  ];

  const upcomingSchedules = [
    { id: 1, subject: 'Web Development', date: '2024-01-22', time: '09:00', teacher: 'Dr. Budi Santoso' },
    { id: 2, subject: 'Mobile Development', date: '2024-01-23', time: '14:00', teacher: 'Prof. Rahman Hidayat' },
    { id: 3, subject: 'Web Development', date: '2024-01-25', time: '09:00', teacher: 'Dr. Budi Santoso' },
  ];

  const recentSessions = [
    { id: 1, subject: 'Web Development', date: '2024-01-19', status: 'present', notes: 'Materi: React Components' },
    { id: 2, subject: 'Mobile Development', date: '2024-01-18', status: 'present', notes: 'Materi: Flutter Widgets' },
    { id: 3, subject: 'Web Development', date: '2024-01-16', status: 'present', notes: 'Materi: JavaScript ES6+' },
  ];

  const progressPercentage = ((studentData.usedSessions / studentData.totalSessions) * 100).toFixed(0);

  return (
    <div className="space-y-6">
      {/* Welcome Card */}
      <div className="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg p-6 text-white">
        <h2 className="text-2xl font-bold mb-2">Selamat Datang, {studentData.name}! 👋</h2>
        <p className="text-blue-100">Terus semangat belajar coding!</p>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center justify-between mb-2">
            <p className="text-sm text-gray-600">Paket Aktif</p>
            <div className="p-2 bg-blue-100 rounded-lg">
              <Package size={20} className="text-blue-600" />
            </div>
          </div>
          <p className="text-3xl font-bold text-gray-800">{studentData.totalActivePackages}</p>
        </div>
        
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center justify-between mb-2">
            <p className="text-sm text-gray-600">Total Sesi</p>
            <div className="p-2 bg-purple-100 rounded-lg">
              <TrendingUp size={20} className="text-purple-600" />
            </div>
          </div>
          <p className="text-3xl font-bold text-gray-800">{studentData.totalSessions}</p>
        </div>

        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center justify-between mb-2">
            <p className="text-sm text-gray-600">Sesi Terpakai</p>
            <div className="p-2 bg-green-100 rounded-lg">
              <TrendingUp size={20} className="text-green-600" />
            </div>
          </div>
          <p className="text-3xl font-bold text-gray-800">{studentData.usedSessions}</p>
        </div>

        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center justify-between mb-2">
            <p className="text-sm text-gray-600">Jadwal Mendatang</p>
            <div className="p-2 bg-orange-100 rounded-lg">
              <Calendar size={20} className="text-orange-600" />
            </div>
          </div>
          <p className="text-3xl font-bold text-gray-800">{studentData.upcomingSchedules}</p>
        </div>
      </div>

      {/* Progress Overview */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
        <h3 className="text-lg font-semibold text-gray-800 mb-4">Progress Pembelajaran</h3>
        <div className="space-y-3">
          <div className="flex items-center justify-between text-sm">
            <span className="text-gray-600">Total Progress</span>
            <span className="font-semibold text-gray-800">{studentData.usedSessions} / {studentData.totalSessions} sesi ({progressPercentage}%)</span>
          </div>
          <div className="w-full bg-gray-200 rounded-full h-3">
            <div 
              className="bg-blue-600 h-3 rounded-full transition-all duration-300"
              style={{ width: `${progressPercentage}%` }}
            ></div>
          </div>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Active Packages */}
        <div className="bg-white rounded-lg shadow-sm border border-gray-100">
          <div className="p-6 border-b border-gray-100">
            <h3 className="text-lg font-semibold text-gray-800">Paket Aktif Saya</h3>
          </div>
          <div className="p-6 space-y-4">
            {activePackages.map((pkg) => {
              const isExpiringSoon = pkg.expiresIn <= 7;
              return (
                <div key={pkg.id} className={`p-4 rounded-lg border-2 ${isExpiringSoon ? 'bg-orange-50 border-orange-200' : 'bg-gray-50 border-gray-200'}`}>
                  <div className="flex items-start justify-between mb-3">
                    <div className="flex-1">
                      <h4 className="font-semibold text-gray-800 mb-1">{pkg.name}</h4>
                      {isExpiringSoon && (
                        <div className="flex items-center gap-1 text-orange-600 text-sm mb-2">
                          <AlertCircle size={16} />
                          <span>Kedaluwarsa dalam {pkg.expiresIn} hari</span>
                        </div>
                      )}
                    </div>
                  </div>
                  <div className="flex items-center justify-between text-sm mb-2">
                    <span className="text-gray-600">Sisa Pertemuan</span>
                    <span className="font-semibold text-gray-800">{pkg.sessionsLeft} / {pkg.totalSessions}</span>
                  </div>
                  <div className="w-full bg-gray-200 rounded-full h-2">
                    <div 
                      className={`h-2 rounded-full ${isExpiringSoon ? 'bg-orange-500' : 'bg-blue-500'}`}
                      style={{ width: `${((pkg.totalSessions - pkg.sessionsLeft) / pkg.totalSessions) * 100}%` }}
                    ></div>
                  </div>
                </div>
              );
            })}
          </div>
        </div>

        {/* Upcoming Schedules */}
        <div className="bg-white rounded-lg shadow-sm border border-gray-100">
          <div className="p-6 border-b border-gray-100">
            <h3 className="text-lg font-semibold text-gray-800">Jadwal Mendatang</h3>
          </div>
          <div className="p-6 space-y-4">
            {upcomingSchedules.map((schedule) => (
              <div key={schedule.id} className="p-4 bg-blue-50 rounded-lg border border-blue-200">
                <div className="flex items-center gap-3 mb-2">
                  <Calendar size={18} className="text-blue-600" />
                  <span className="font-semibold text-gray-800">{schedule.subject}</span>
                </div>
                <div className="space-y-1 text-sm text-gray-600">
                  <p>📅 {schedule.date} • {schedule.time}</p>
                  <p>👨‍🏫 {schedule.teacher}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Recent Sessions */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100">
        <div className="p-6 border-b border-gray-100">
          <h3 className="text-lg font-semibold text-gray-800">Pertemuan Terakhir</h3>
        </div>
        <div className="divide-y divide-gray-100">
          {recentSessions.map((session) => (
            <div key={session.id} className="p-6 hover:bg-gray-50 transition-colors">
              <div className="flex items-center justify-between">
                <div>
                  <h4 className="font-semibold text-gray-800 mb-1">{session.subject}</h4>
                  <p className="text-sm text-gray-600">{session.notes}</p>
                  <p className="text-xs text-gray-500 mt-1">{session.date}</p>
                </div>
                <span className="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">
                  Hadir
                </span>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
