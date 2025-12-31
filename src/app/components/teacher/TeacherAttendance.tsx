import { useState } from 'react';
import { CheckCircle, XCircle, Save } from 'lucide-react';

interface Session {
  id: number;
  student: string;
  subject: string;
  date: string;
  time: string;
  packageName: string;
}

interface AttendanceForm {
  sessionId: number;
  status: 'present' | 'absent' | null;
  notes: string;
}

export function TeacherAttendance() {
  const [selectedDate] = useState('2024-01-20');
  const [attendanceForms, setAttendanceForms] = useState<Record<number, AttendanceForm>>({});

  const sessions: Session[] = [
    { id: 1, student: 'Ahmad Fauzi', subject: 'Web Development', date: '2024-01-20', time: '09:00', packageName: 'Paket Web Development Basic' },
    { id: 2, student: 'Siti Nurhaliza', subject: 'Web Development', date: '2024-01-20', time: '11:00', packageName: 'Paket Web Development Basic' },
    { id: 3, student: 'Dewi Lestari', subject: 'Web Development', date: '2024-01-20', time: '14:00', packageName: 'Paket Web Development Advanced' },
    { id: 4, student: 'Lisa Wijaya', subject: 'UI/UX Design', date: '2024-01-20', time: '16:00', packageName: 'Paket UI/UX Design' },
  ];

  const handleStatusChange = (sessionId: number, status: 'present' | 'absent') => {
    setAttendanceForms(prev => ({
      ...prev,
      [sessionId]: {
        ...prev[sessionId],
        sessionId,
        status,
        notes: prev[sessionId]?.notes || ''
      }
    }));
  };

  const handleNotesChange = (sessionId: number, notes: string) => {
    setAttendanceForms(prev => ({
      ...prev,
      [sessionId]: {
        ...prev[sessionId],
        sessionId,
        status: prev[sessionId]?.status || null,
        notes
      }
    }));
  };

  const handleSave = (sessionId: number) => {
    const form = attendanceForms[sessionId];
    if (form && form.status) {
      alert(`Kehadiran untuk sesi #${sessionId} berhasil disimpan!\nStatus: ${form.status === 'present' ? 'Hadir' : 'Tidak Hadir'}\nCatatan: ${form.notes || '-'}`);
    } else {
      alert('Silakan pilih status kehadiran terlebih dahulu!');
    }
  };

  const completedCount = Object.values(attendanceForms).filter(f => f.status !== null).length;

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h2 className="text-2xl font-bold text-gray-800">Isi Kehadiran</h2>
        <p className="text-sm text-gray-600 mt-1">Catat kehadiran dan materi pertemuan</p>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Total Sesi Hari Ini</p>
          <p className="text-3xl font-bold text-gray-800">{sessions.length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Sudah Dicatat</p>
          <p className="text-3xl font-bold text-green-600">{completedCount}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Belum Dicatat</p>
          <p className="text-3xl font-bold text-orange-600">{sessions.length - completedCount}</p>
        </div>
      </div>

      {/* Date Info */}
      <div className="bg-purple-50 border border-purple-200 rounded-lg p-4">
        <p className="text-sm text-purple-700">
          📅 Menampilkan sesi untuk tanggal: <span className="font-semibold">{selectedDate}</span>
        </p>
      </div>

      {/* Sessions List */}
      <div className="space-y-4">
        {sessions.map((session) => {
          const form = attendanceForms[session.id];
          const isFilled = form && form.status !== null;

          return (
            <div key={session.id} className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
              <div className={`h-2 ${isFilled ? 'bg-green-500' : 'bg-gray-300'}`}></div>
              <div className="p-6">
                {/* Session Info */}
                <div className="mb-6">
                  <div className="flex items-start justify-between mb-3">
                    <div>
                      <div className="flex items-center gap-3 mb-2">
                        <span className="px-3 py-1 bg-purple-100 text-purple-700 font-semibold rounded-lg">
                          {session.time}
                        </span>
                        <h3 className="text-lg font-semibold text-gray-800">{session.subject}</h3>
                      </div>
                      <div className="space-y-1 text-sm text-gray-600">
                        <p>👨‍🎓 Murid: <span className="font-medium text-gray-800">{session.student}</span></p>
                        <p>📦 Paket: <span className="font-medium text-gray-800">{session.packageName}</span></p>
                      </div>
                    </div>
                    {isFilled && (
                      <span className="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">
                        ✓ Sudah Dicatat
                      </span>
                    )}
                  </div>
                </div>

                {/* Attendance Form */}
                <div className="space-y-4 border-t border-gray-200 pt-6">
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-3">Status Kehadiran</label>
                    <div className="flex gap-4">
                      <button
                        onClick={() => handleStatusChange(session.id, 'present')}
                        className={`flex-1 py-3 px-4 rounded-lg border-2 transition-all ${
                          form?.status === 'present'
                            ? 'border-green-500 bg-green-50'
                            : 'border-gray-200 hover:border-green-300'
                        }`}
                      >
                        <div className="flex items-center justify-center gap-2">
                          <CheckCircle size={20} className={form?.status === 'present' ? 'text-green-600' : 'text-gray-400'} />
                          <span className={`font-medium ${form?.status === 'present' ? 'text-green-700' : 'text-gray-600'}`}>
                            Hadir
                          </span>
                        </div>
                      </button>
                      <button
                        onClick={() => handleStatusChange(session.id, 'absent')}
                        className={`flex-1 py-3 px-4 rounded-lg border-2 transition-all ${
                          form?.status === 'absent'
                            ? 'border-red-500 bg-red-50'
                            : 'border-gray-200 hover:border-red-300'
                        }`}
                      >
                        <div className="flex items-center justify-center gap-2">
                          <XCircle size={20} className={form?.status === 'absent' ? 'text-red-600' : 'text-gray-400'} />
                          <span className={`font-medium ${form?.status === 'absent' ? 'text-red-700' : 'text-gray-600'}`}>
                            Tidak Hadir
                          </span>
                        </div>
                      </button>
                    </div>
                  </div>

                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-2">
                      Catatan Materi / Keterangan
                    </label>
                    <textarea
                      rows={3}
                      value={form?.notes || ''}
                      onChange={(e) => handleNotesChange(session.id, e.target.value)}
                      placeholder={form?.status === 'present' 
                        ? 'Contoh: Materi React Hooks - useState dan useEffect. Siswa memahami konsep dengan baik.'
                        : 'Contoh: Sakit / Izin / dll.'
                      }
                      className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    />
                  </div>

                  <button
                    onClick={() => handleSave(session.id)}
                    disabled={!form?.status}
                    className={`w-full py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 ${
                      form?.status
                        ? 'bg-purple-600 text-white hover:bg-purple-700'
                        : 'bg-gray-200 text-gray-400 cursor-not-allowed'
                    }`}
                  >
                    <Save size={20} />
                    Simpan Kehadiran
                  </button>
                </div>
              </div>
            </div>
          );
        })}
      </div>

      {/* Info Card */}
      <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <h4 className="font-semibold text-blue-900 mb-2">💡 Panduan Pengisian</h4>
        <ul className="text-sm text-blue-800 space-y-1">
          <li>• Pilih status kehadiran (Hadir/Tidak Hadir) untuk setiap sesi</li>
          <li>• Jika murid hadir, isi catatan materi yang diajarkan</li>
          <li>• Jika murid tidak hadir, isi keterangan (sakit, izin, dll.)</li>
          <li>• Klik tombol "Simpan Kehadiran" untuk menyimpan data</li>
        </ul>
      </div>
    </div>
  );
}
