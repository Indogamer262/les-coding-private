import { useState } from 'react';
import { Plus, Calendar as CalendarIcon } from 'lucide-react';

interface Schedule {
  id: number;
  studentName: string;
  teacherName: string;
  subject: string;
  date: string;
  time: string;
  duration: number;
  status: 'scheduled' | 'completed' | 'cancelled';
}

export function ManageSchedules() {
  const [showAddModal, setShowAddModal] = useState(false);
  const [selectedDate, setSelectedDate] = useState('2024-01-20');

  const [schedules] = useState<Schedule[]>([
    { id: 1, studentName: 'Ahmad Fauzi', teacherName: 'Dr. Budi Santoso', subject: 'Web Development', date: '2024-01-20', time: '09:00', duration: 120, status: 'scheduled' },
    { id: 2, studentName: 'Siti Nurhaliza', teacherName: 'Prof. Rahman Hidayat', subject: 'Mobile Development', date: '2024-01-20', time: '11:00', duration: 120, status: 'scheduled' },
    { id: 3, studentName: 'Dewi Lestari', teacherName: 'Dr. Budi Santoso', subject: 'Web Development', date: '2024-01-20', time: '14:00', duration: 120, status: 'completed' },
    { id: 4, studentName: 'Rahman Hidayat', teacherName: 'Prof. Rahman Hidayat', subject: 'Data Science', date: '2024-01-20', time: '16:00', duration: 120, status: 'scheduled' },
    { id: 5, studentName: 'Lisa Wijaya', teacherName: 'Dr. Budi Santoso', subject: 'UI/UX Design', date: '2024-01-21', time: '09:00', duration: 120, status: 'scheduled' },
  ]);

  const filteredSchedules = schedules.filter(s => s.date === selectedDate);

  const getStatusBadge = (status: string) => {
    switch(status) {
      case 'scheduled':
        return 'bg-blue-100 text-blue-700';
      case 'completed':
        return 'bg-green-100 text-green-700';
      case 'cancelled':
        return 'bg-red-100 text-red-700';
      default:
        return 'bg-gray-100 text-gray-700';
    }
  };

  const getStatusText = (status: string) => {
    switch(status) {
      case 'scheduled':
        return 'Terjadwal';
      case 'completed':
        return 'Selesai';
      case 'cancelled':
        return 'Dibatalkan';
      default:
        return status;
    }
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div>
          <h2 className="text-2xl font-bold text-gray-800">Kelola Jadwal</h2>
          <p className="text-sm text-gray-600 mt-1">Kelola jadwal pertemuan les</p>
        </div>
        <button 
          onClick={() => setShowAddModal(true)}
          className="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
        >
          <Plus size={20} />
          Tambah Jadwal
        </button>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Jadwal Hari Ini</p>
          <p className="text-3xl font-bold text-blue-600">{filteredSchedules.length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Selesai</p>
          <p className="text-3xl font-bold text-green-600">{filteredSchedules.filter(s => s.status === 'completed').length}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <p className="text-sm text-gray-600 mb-1">Terjadwal</p>
          <p className="text-3xl font-bold text-gray-800">{filteredSchedules.filter(s => s.status === 'scheduled').length}</p>
        </div>
      </div>

      {/* Date Filter */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
        <div className="flex items-center gap-3">
          <CalendarIcon size={20} className="text-blue-600" />
          <label className="text-sm font-medium text-gray-700">Pilih Tanggal:</label>
          <input
            type="date"
            value={selectedDate}
            onChange={(e) => setSelectedDate(e.target.value)}
            className="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
          />
        </div>
      </div>

      {/* Schedule List */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100">
        <div className="p-6 border-b border-gray-100">
          <h3 className="text-lg font-semibold text-gray-800">
            Jadwal Tanggal {selectedDate}
          </h3>
        </div>
        <div className="divide-y divide-gray-100">
          {filteredSchedules.length > 0 ? (
            filteredSchedules.map((schedule) => (
              <div key={schedule.id} className="p-6 hover:bg-gray-50 transition-colors">
                <div className="flex items-center justify-between">
                  <div className="flex-1">
                    <div className="flex items-center gap-3 mb-2">
                      <span className="text-lg font-semibold text-blue-600">{schedule.time}</span>
                      <span className={`px-3 py-1 rounded-full text-xs font-medium ${getStatusBadge(schedule.status)}`}>
                        {getStatusText(schedule.status)}
                      </span>
                    </div>
                    <h4 className="font-semibold text-gray-800 mb-1">{schedule.subject}</h4>
                    <div className="flex items-center gap-4 text-sm text-gray-600">
                      <span>👨‍🎓 {schedule.studentName}</span>
                      <span>👨‍🏫 {schedule.teacherName}</span>
                      <span>⏱️ {schedule.duration} menit</span>
                    </div>
                  </div>
                  <button className="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    Detail
                  </button>
                </div>
              </div>
            ))
          ) : (
            <div className="p-12 text-center text-gray-500">
              Tidak ada jadwal pada tanggal ini
            </div>
          )}
        </div>
      </div>

      {/* Add Modal */}
      {showAddModal && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
          <div className="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 className="text-xl font-bold text-gray-800 mb-4">Tambah Jadwal Baru</h3>
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
                <label className="block text-sm font-medium text-gray-700 mb-1">Pengajar</label>
                <select className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                  <option>Pilih Pengajar</option>
                  <option>Dr. Budi Santoso</option>
                  <option>Prof. Rahman Hidayat</option>
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                <select className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                  <option>Web Development</option>
                  <option>Mobile Development</option>
                  <option>Data Science</option>
                  <option>UI/UX Design</option>
                </select>
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                  <input type="date" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                  <input type="time" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                </div>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Durasi (menit)</label>
                <input type="number" defaultValue="120" className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
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
