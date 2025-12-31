import { CheckCircle, XCircle, Calendar } from 'lucide-react';

interface Session {
  id: number;
  subject: string;
  teacher: string;
  date: string;
  time: string;
  status: 'present' | 'absent';
  notes: string;
  packageName: string;
}

export function StudentHistory() {
  const sessions: Session[] = [
    { id: 1, subject: 'Web Development', teacher: 'Dr. Budi Santoso', date: '2024-01-19', time: '09:00', status: 'present', notes: 'Materi: React Components - Belajar functional component, props, dan state management', packageName: 'Paket Web Development Basic' },
    { id: 2, subject: 'Mobile Development', teacher: 'Prof. Rahman Hidayat', date: '2024-01-18', time: '14:00', status: 'present', notes: 'Materi: Flutter Widgets - Implementasi Stateful dan Stateless widgets', packageName: 'Paket Mobile App Development' },
    { id: 3, subject: 'Web Development', teacher: 'Dr. Budi Santoso', date: '2024-01-16', time: '09:00', status: 'present', notes: 'Materi: JavaScript ES6+ - Arrow functions, destructuring, spread operator', packageName: 'Paket Web Development Basic' },
    { id: 4, subject: 'Mobile Development', teacher: 'Prof. Rahman Hidayat', date: '2024-01-15', time: '14:00', status: 'absent', notes: 'Izin sakit', packageName: 'Paket Mobile App Development' },
    { id: 5, subject: 'Web Development', teacher: 'Dr. Budi Santoso', date: '2024-01-12', time: '09:00', status: 'present', notes: 'Materi: HTML & CSS Advanced - Flexbox dan Grid layout', packageName: 'Paket Web Development Basic' },
    { id: 6, subject: 'Mobile Development', teacher: 'Prof. Rahman Hidayat', date: '2024-01-11', time: '14:00', status: 'present', notes: 'Materi: Dart Basics - Syntax, variables, dan control flow', packageName: 'Paket Mobile App Development' },
  ];

  const presentCount = sessions.filter(s => s.status === 'present').length;
  const absentCount = sessions.filter(s => s.status === 'absent').length;
  const attendanceRate = ((presentCount / sessions.length) * 100).toFixed(1);

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h2 className="text-2xl font-bold text-gray-800">Riwayat Pertemuan</h2>
        <p className="text-sm text-gray-600 mt-1">Riwayat kehadiran dan catatan materi</p>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Total Pertemuan</p>
          <p className="text-3xl font-bold text-gray-800">{sessions.length}</p>
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

      {/* Sessions List */}
      <div className="space-y-4">
        {sessions.map((session) => (
          <div key={session.id} className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div className={`h-2 ${session.status === 'present' ? 'bg-green-500' : 'bg-red-500'}`}></div>
            <div className="p-6">
              <div className="flex items-start justify-between mb-4">
                <div className="flex-1">
                  <div className="flex items-center gap-3 mb-2">
                    <h3 className="text-lg font-semibold text-gray-800">{session.subject}</h3>
                    {session.status === 'present' ? (
                      <div className="flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 rounded-full">
                        <CheckCircle size={16} />
                        <span className="text-sm font-medium">Hadir</span>
                      </div>
                    ) : (
                      <div className="flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 rounded-full">
                        <XCircle size={16} />
                        <span className="text-sm font-medium">Tidak Hadir</span>
                      </div>
                    )}
                  </div>
                  <div className="flex items-center gap-2 text-sm text-gray-600 mb-3">
                    <Calendar size={16} />
                    <span>{session.date} • {session.time}</span>
                  </div>
                </div>
              </div>

              <div className="space-y-3">
                <div className="flex items-start gap-2 text-sm">
                  <span className="text-gray-600 w-24">Pengajar:</span>
                  <span className="font-medium text-gray-800">{session.teacher}</span>
                </div>
                <div className="flex items-start gap-2 text-sm">
                  <span className="text-gray-600 w-24">Paket:</span>
                  <span className="font-medium text-gray-800">{session.packageName}</span>
                </div>
                <div className="flex items-start gap-2 text-sm">
                  <span className="text-gray-600 w-24">Catatan:</span>
                  <span className="text-gray-800">{session.notes}</span>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
