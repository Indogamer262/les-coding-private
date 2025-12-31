import { useState } from 'react';
import { Search, CheckCircle, XCircle } from 'lucide-react';

interface Attendance {
  id: number;
  studentName: string;
  teacherName: string;
  subject: string;
  date: string;
  time: string;
  status: 'present' | 'absent';
  notes: string;
}

export function AttendanceHistory() {
  const [searchTerm, setSearchTerm] = useState('');
  const [filterStatus, setFilterStatus] = useState<'all' | 'present' | 'absent'>('all');

  const [attendances] = useState<Attendance[]>([
    { id: 1, studentName: 'Ahmad Fauzi', teacherName: 'Dr. Budi Santoso', subject: 'Web Development', date: '2024-01-19', time: '09:00', status: 'present', notes: 'Materi: React Components' },
    { id: 2, studentName: 'Siti Nurhaliza', teacherName: 'Prof. Rahman Hidayat', subject: 'Mobile Development', date: '2024-01-19', time: '11:00', status: 'present', notes: 'Materi: Flutter Widgets' },
    { id: 3, studentName: 'Dewi Lestari', teacherName: 'Dr. Budi Santoso', subject: 'Web Development', date: '2024-01-19', time: '14:00', status: 'absent', notes: 'Sakit' },
    { id: 4, studentName: 'Rahman Hidayat', teacherName: 'Prof. Rahman Hidayat', subject: 'Data Science', date: '2024-01-18', time: '16:00', status: 'present', notes: 'Materi: Machine Learning Basics' },
    { id: 5, studentName: 'Lisa Wijaya', teacherName: 'Dr. Budi Santoso', subject: 'UI/UX Design', date: '2024-01-18', time: '09:00', status: 'present', notes: 'Materi: Design System' },
    { id: 6, studentName: 'Andi Setiawan', teacherName: 'Prof. Rahman Hidayat', subject: 'Mobile Development', date: '2024-01-17', time: '11:00', status: 'present', notes: 'Materi: State Management' },
    { id: 7, studentName: 'Putri Amelia', teacherName: 'Dr. Budi Santoso', subject: 'Web Development', date: '2024-01-17', time: '14:00', status: 'absent', notes: 'Izin' },
  ]);

  const filteredAttendances = attendances.filter(attendance => {
    const matchesSearch = attendance.studentName.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         attendance.subject.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesStatus = filterStatus === 'all' || attendance.status === filterStatus;
    return matchesSearch && matchesStatus;
  });

  const presentCount = attendances.filter(a => a.status === 'present').length;
  const absentCount = attendances.filter(a => a.status === 'absent').length;
  const attendanceRate = ((presentCount / attendances.length) * 100).toFixed(1);

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h2 className="text-2xl font-bold text-gray-800">Riwayat Kehadiran</h2>
        <p className="text-sm text-gray-600 mt-1">Riwayat kehadiran seluruh pertemuan</p>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Total Pertemuan</p>
          <p className="text-3xl font-bold text-gray-800">{attendances.length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Hadir</p>
          <p className="text-3xl font-bold text-green-600">{presentCount}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Tidak Hadir</p>
          <p className="text-3xl font-bold text-red-600">{absentCount}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Tingkat Kehadiran</p>
          <p className="text-3xl font-bold text-blue-600">{attendanceRate}%</p>
        </div>
      </div>

      {/* Filters */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
        <div className="flex flex-col md:flex-row gap-4">
          <div className="flex-1 relative">
            <Search size={20} className="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
            <input
              type="text"
              placeholder="Cari nama murid atau mata pelajaran..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
          </div>
          <div className="flex gap-2">
            <button
              onClick={() => setFilterStatus('all')}
              className={`px-4 py-2 rounded-lg transition-colors ${
                filterStatus === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Semua
            </button>
            <button
              onClick={() => setFilterStatus('present')}
              className={`px-4 py-2 rounded-lg transition-colors ${
                filterStatus === 'present' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Hadir
            </button>
            <button
              onClick={() => setFilterStatus('absent')}
              className={`px-4 py-2 rounded-lg transition-colors ${
                filterStatus === 'absent' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Tidak Hadir
            </button>
          </div>
        </div>
      </div>

      {/* Attendance List */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead className="bg-gray-50 border-b border-gray-200">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Murid</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengajar</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {filteredAttendances.map((attendance) => (
                <tr key={attendance.id} className="hover:bg-gray-50 transition-colors">
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm">
                      <div className="font-medium text-gray-800">{attendance.date}</div>
                      <div className="text-gray-600">{attendance.time}</div>
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span className="font-medium text-gray-800">{attendance.studentName}</span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {attendance.teacherName}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    {attendance.subject}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="flex items-center gap-2">
                      {attendance.status === 'present' ? (
                        <>
                          <CheckCircle size={18} className="text-green-500" />
                          <span className="text-sm font-medium text-green-700">Hadir</span>
                        </>
                      ) : (
                        <>
                          <XCircle size={18} className="text-red-500" />
                          <span className="text-sm font-medium text-red-700">Tidak Hadir</span>
                        </>
                      )}
                    </div>
                  </td>
                  <td className="px-6 py-4">
                    <span className="text-sm text-gray-600">{attendance.notes}</span>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}
