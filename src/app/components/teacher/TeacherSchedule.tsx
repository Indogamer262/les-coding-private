import { Calendar, Clock } from 'lucide-react';

interface Schedule {
  id: number;
  student: string;
  subject: string;
  date: string;
  time: string;
  duration: number;
  location: string;
  packageName: string;
}

export function TeacherSchedule() {
  const schedules: Schedule[] = [
    { id: 1, student: 'Ahmad Fauzi', subject: 'Web Development', date: '2024-01-22', time: '09:00', duration: 120, location: 'Online - Zoom', packageName: 'Paket Web Development Basic' },
    { id: 2, student: 'Dewi Lestari', subject: 'Web Development', date: '2024-01-22', time: '14:00', duration: 120, location: 'Online - Zoom', packageName: 'Paket Web Development Advanced' },
    { id: 3, student: 'Ahmad Fauzi', subject: 'Web Development', date: '2024-01-23', time: '09:00', duration: 120, location: 'Online - Zoom', packageName: 'Paket Web Development Basic' },
    { id: 4, student: 'Siti Nurhaliza', subject: 'Web Development', date: '2024-01-23', time: '11:00', duration: 120, location: 'Online - Google Meet', packageName: 'Paket Web Development Basic' },
    { id: 5, student: 'Dewi Lestari', subject: 'Web Development', date: '2024-01-24', time: '14:00', duration: 120, location: 'Online - Zoom', packageName: 'Paket Web Development Advanced' },
    { id: 6, student: 'Lisa Wijaya', subject: 'UI/UX Design', date: '2024-01-24', time: '16:00', duration: 120, location: 'Online - Zoom', packageName: 'Paket UI/UX Design' },
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
        <h2 className="text-2xl font-bold text-gray-800">Jadwal Mengajar</h2>
        <p className="text-sm text-gray-600 mt-1">Jadwal mengajar mendatang</p>
      </div>

      {/* Summary Card */}
      <div className="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg shadow-lg p-6 text-white">
        <div className="flex items-center justify-between">
          <div>
            <p className="text-purple-100 mb-1">Total Jadwal Mengajar</p>
            <p className="text-4xl font-bold">{schedules.length}</p>
          </div>
          <Calendar size={48} className="text-purple-300" />
        </div>
      </div>

      {/* Schedule List */}
      <div className="space-y-6">
        {Object.entries(groupedSchedules).map(([date, daySchedules]) => (
          <div key={date} className="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div className="bg-purple-50 px-6 py-4 border-b border-purple-100">
              <div className="flex items-center gap-2">
                <Calendar size={20} className="text-purple-600" />
                <h3 className="font-semibold text-gray-800">{formatDate(date)}</h3>
                <span className="ml-auto px-3 py-1 bg-purple-600 text-white text-sm font-medium rounded-full">
                  {daySchedules.length} sesi
                </span>
              </div>
            </div>
            <div className="divide-y divide-gray-100">
              {daySchedules.map((schedule) => (
                <div key={schedule.id} className="p-6 hover:bg-gray-50 transition-colors">
                  <div className="flex items-start justify-between">
                    <div className="flex-1">
                      <div className="flex items-center gap-3 mb-3">
                        <div className="px-3 py-1 bg-purple-600 text-white rounded-lg">
                          <Clock size={16} className="inline mr-1" />
                          <span className="font-semibold">{schedule.time}</span>
                        </div>
                        <span className="text-sm text-gray-600">{schedule.duration} menit</span>
                      </div>
                      
                      <h4 className="text-lg font-semibold text-gray-800 mb-2">{schedule.subject}</h4>
                      
                      <div className="grid grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                          <span className="block text-gray-500 mb-1">Murid</span>
                          <span className="font-medium text-gray-800">{schedule.student}</span>
                        </div>
                        <div>
                          <span className="block text-gray-500 mb-1">Paket</span>
                          <span className="font-medium text-gray-800">{schedule.packageName}</span>
                        </div>
                        <div className="col-span-2">
                          <span className="block text-gray-500 mb-1">Lokasi</span>
                          <span className="font-medium text-gray-800">{schedule.location}</span>
                        </div>
                      </div>
                    </div>
                    
                    <button className="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                      Lihat Detail
                    </button>
                  </div>
                </div>
              ))}
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
