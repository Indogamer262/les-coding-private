import { Calendar, Users, CheckCircle, Clock } from 'lucide-react';

export function TeacherDashboard() {
  const teacherStats = {
    todaySchedules: 5,
    totalStudents: 18,
    completedToday: 3,
    pendingToday: 2,
  };

  const todaySchedules = [
    { id: 1, time: '09:00', student: 'Ahmad Fauzi', subject: 'Web Development', status: 'completed' },
    { id: 2, time: '11:00', student: 'Siti Nurhaliza', subject: 'Web Development', status: 'completed' },
    { id: 3, time: '14:00', student: 'Dewi Lestari', subject: 'Web Development', status: 'completed' },
    { id: 4, time: '16:00', student: 'Rahman Hidayat', subject: 'Web Development', status: 'pending' },
    { id: 5, time: '18:00', student: 'Lisa Wijaya', subject: 'UI/UX Design', status: 'pending' },
  ];

  const upcomingSchedules = [
    { id: 1, date: '2024-01-23', time: '09:00', student: 'Ahmad Fauzi', subject: 'Web Development' },
    { id: 2, date: '2024-01-23', time: '14:00', student: 'Dewi Lestari', subject: 'Web Development' },
    { id: 3, date: '2024-01-24', time: '11:00', student: 'Siti Nurhaliza', subject: 'Web Development' },
  ];

  const recentFeedback = [
    { id: 1, student: 'Ahmad Fauzi', session: 'React Components', date: '2024-01-19', notes: 'Pemahaman bagus tentang functional components' },
    { id: 2, student: 'Siti Nurhaliza', session: 'JavaScript ES6', date: '2024-01-18', notes: 'Perlu latihan lebih untuk async/await' },
  ];

  return (
    <div className="space-y-6">
      {/* Welcome Card */}
      <div className="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg shadow-lg p-6 text-white">
        <h2 className="text-2xl font-bold mb-2">Selamat Datang, Jane Smith! 👋</h2>
        <p className="text-purple-100">Anda memiliki {teacherStats.todaySchedules} jadwal mengajar hari ini</p>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center justify-between mb-2">
            <p className="text-sm text-gray-600">Jadwal Hari Ini</p>
            <div className="p-2 bg-blue-100 rounded-lg">
              <Calendar size={20} className="text-blue-600" />
            </div>
          </div>
          <p className="text-3xl font-bold text-gray-800">{teacherStats.todaySchedules}</p>
        </div>
        
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center justify-between mb-2">
            <p className="text-sm text-gray-600">Total Murid</p>
            <div className="p-2 bg-purple-100 rounded-lg">
              <Users size={20} className="text-purple-600" />
            </div>
          </div>
          <p className="text-3xl font-bold text-gray-800">{teacherStats.totalStudents}</p>
        </div>

        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center justify-between mb-2">
            <p className="text-sm text-gray-600">Selesai Hari Ini</p>
            <div className="p-2 bg-green-100 rounded-lg">
              <CheckCircle size={20} className="text-green-600" />
            </div>
          </div>
          <p className="text-3xl font-bold text-green-600">{teacherStats.completedToday}</p>
        </div>

        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
          <div className="flex items-center justify-between mb-2">
            <p className="text-sm text-gray-600">Belum Dimulai</p>
            <div className="p-2 bg-orange-100 rounded-lg">
              <Clock size={20} className="text-orange-600" />
            </div>
          </div>
          <p className="text-3xl font-bold text-orange-600">{teacherStats.pendingToday}</p>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Today's Schedule */}
        <div className="bg-white rounded-lg shadow-sm border border-gray-100">
          <div className="p-6 border-b border-gray-100">
            <h3 className="text-lg font-semibold text-gray-800">Jadwal Hari Ini</h3>
          </div>
          <div className="divide-y divide-gray-100">
            {todaySchedules.map((schedule) => (
              <div key={schedule.id} className="p-4 hover:bg-gray-50 transition-colors">
                <div className="flex items-center justify-between">
                  <div className="flex items-center gap-3">
                    <div className="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg font-semibold">
                      {schedule.time}
                    </div>
                    <div>
                      <p className="font-medium text-gray-800">{schedule.student}</p>
                      <p className="text-sm text-gray-600">{schedule.subject}</p>
                    </div>
                  </div>
                  <span className={`px-3 py-1 text-xs font-medium rounded-full ${
                    schedule.status === 'completed' 
                      ? 'bg-green-100 text-green-700' 
                      : 'bg-orange-100 text-orange-700'
                  }`}>
                    {schedule.status === 'completed' ? 'Selesai' : 'Pending'}
                  </span>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Upcoming Schedules */}
        <div className="bg-white rounded-lg shadow-sm border border-gray-100">
          <div className="p-6 border-b border-gray-100">
            <h3 className="text-lg font-semibold text-gray-800">Jadwal Mendatang</h3>
          </div>
          <div className="p-6 space-y-4">
            {upcomingSchedules.map((schedule) => (
              <div key={schedule.id} className="p-4 bg-purple-50 rounded-lg border border-purple-200">
                <div className="flex items-center gap-3 mb-2">
                  <Calendar size={18} className="text-purple-600" />
                  <span className="font-semibold text-gray-800">{schedule.date}</span>
                  <span className="text-gray-600">•</span>
                  <span className="font-semibold text-purple-600">{schedule.time}</span>
                </div>
                <div className="space-y-1 text-sm">
                  <p className="font-medium text-gray-800">{schedule.student}</p>
                  <p className="text-gray-600">{schedule.subject}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Recent Feedback */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-100">
        <div className="p-6 border-b border-gray-100">
          <h3 className="text-lg font-semibold text-gray-800">Catatan Pertemuan Terakhir</h3>
        </div>
        <div className="divide-y divide-gray-100">
          {recentFeedback.map((feedback) => (
            <div key={feedback.id} className="p-6 hover:bg-gray-50 transition-colors">
              <div className="flex items-start justify-between mb-2">
                <div>
                  <h4 className="font-semibold text-gray-800">{feedback.student}</h4>
                  <p className="text-sm text-gray-600">{feedback.session} • {feedback.date}</p>
                </div>
              </div>
              <p className="text-sm text-gray-700 mt-2">{feedback.notes}</p>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
