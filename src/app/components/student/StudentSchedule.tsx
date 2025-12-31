import { Calendar, Clock } from 'lucide-react';

interface Schedule {
  id: number;
  subject: string;
  teacher: string;
  date: string;
  time: string;
  duration: number;
  location: string;
}

export function StudentSchedule() {
  const schedules: Schedule[] = [
    { id: 1, subject: 'Web Development', teacher: 'Dr. Budi Santoso', date: '2024-01-22', time: '09:00', duration: 120, location: 'Online - Zoom' },
    { id: 2, subject: 'Mobile Development', teacher: 'Prof. Rahman Hidayat', date: '2024-01-23', time: '14:00', duration: 120, location: 'Online - Google Meet' },
    { id: 3, subject: 'Web Development', teacher: 'Dr. Budi Santoso', date: '2024-01-25', time: '09:00', duration: 120, location: 'Online - Zoom' },
    { id: 4, subject: 'Mobile Development', teacher: 'Prof. Rahman Hidayat', date: '2024-01-26', time: '14:00', duration: 120, location: 'Online - Google Meet' },
    { id: 5, subject: 'Web Development', teacher: 'Dr. Budi Santoso', date: '2024-01-29', time: '09:00', duration: 120, location: 'Online - Zoom' },
  ];

  const groupedSchedules = schedules.reduce((acc, schedule) => {
    const date = schedule.date;
    if (!acc[date]) {
      acc[date] = [];
    }
    acc[date].push(schedule);
    return acc;
  }, {} as Record<string, Schedule[]>);

  const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    return `${days[date.getDay()]}, ${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <h2 className="text-2xl font-bold text-gray-800">Jadwal Les</h2>
        <p className="text-sm text-gray-600 mt-1">Jadwal pertemuan les mendatang</p>
      </div>

      {/* Summary Card */}
      <div className="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg p-6 text-white">
        <div className="flex items-center justify-between">
          <div>
            <p className="text-blue-100 mb-1">Total Jadwal Mendatang</p>
            <p className="text-4xl font-bold">{schedules.length}</p>
          </div>
          <Calendar size={48} className="text-blue-300" />
        </div>
      </div>

      {/* Schedule List */}
      <div className="space-y-6">
        {Object.entries(groupedSchedules).map(([date, daySchedules]) => (
          <div key={date} className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div className="bg-blue-50 px-6 py-4 border-b border-blue-100">
              <div className="flex items-center gap-2">
                <Calendar size={20} className="text-blue-600" />
                <h3 className="font-semibold text-gray-800">{formatDate(date)}</h3>
              </div>
            </div>
            <div className="divide-y divide-gray-100">
              {daySchedules.map((schedule) => (
                <div key={schedule.id} className="p-6 hover:bg-gray-50 transition-colors">
                  <div className="flex items-start justify-between">
                    <div className="flex-1">
                      <div className="flex items-center gap-3 mb-3">
                        <div className="px-3 py-1 bg-blue-600 text-white rounded-lg">
                          <Clock size={16} className="inline mr-1" />
                          <span className="font-semibold">{schedule.time}</span>
                        </div>
                        <span className="text-sm text-gray-600">{schedule.duration} menit</span>
                      </div>
                      
                      <h4 className="text-lg font-semibold text-gray-800 mb-2">{schedule.subject}</h4>
                      
                      <div className="space-y-2 text-sm text-gray-600">
                        <div className="flex items-center gap-2">
                          <span className="w-24">Pengajar</span>
                          <span className="font-medium text-gray-800">{schedule.teacher}</span>
                        </div>
                        <div className="flex items-center gap-2">
                          <span className="w-24">Lokasi</span>
                          <span className="font-medium text-gray-800">{schedule.location}</span>
                        </div>
                      </div>
                    </div>
                    
                    <button className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                      Detail
                    </button>
                  </div>
                </div>
              ))}
            </div>
          </div>
        ))}
      </div>

      {/* Empty State */}
      {schedules.length === 0 && (
        <div className="bg-white rounded-lg shadow-sm border border-gray-100 p-12 text-center">
          <Calendar size={48} className="text-gray-400 mx-auto mb-4" />
          <h3 className="text-lg font-semibold text-gray-800 mb-2">Belum Ada Jadwal</h3>
          <p className="text-gray-600">Jadwal pertemuan les akan muncul di sini</p>
        </div>
      )}
    </div>
  );
}
