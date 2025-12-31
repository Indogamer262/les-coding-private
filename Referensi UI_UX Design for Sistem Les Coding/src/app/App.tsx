import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { useState } from 'react';
import { Sidebar } from './components/Sidebar';
import { AdminDashboard } from './components/admin/AdminDashboard';
import { ManageAccounts } from './components/admin/ManageAccounts';
import { ManagePackages } from './components/admin/ManagePackages';
import { ManagePurchases } from './components/admin/ManagePurchases';
import { ManageSchedules } from './components/admin/ManageSchedules';
import { AttendanceHistory } from './components/admin/AttendanceHistory';
import { StudentDashboard } from './components/student/StudentDashboard';
import { StudentPackages } from './components/student/StudentPackages';
import { StudentSchedule } from './components/student/StudentSchedule';
import { StudentHistory } from './components/student/StudentHistory';
import { TeacherDashboard } from './components/teacher/TeacherDashboard';
import { TeacherSchedule } from './components/teacher/TeacherSchedule';
import { TeacherAttendance } from './components/teacher/TeacherAttendance';

type UserRole = 'admin' | 'student' | 'teacher';

function App() {
  const [currentRole, setCurrentRole] = useState<UserRole>('admin');
  const [sidebarOpen, setSidebarOpen] = useState(true);

  return (
    <Router>
      <div className="flex h-screen bg-gray-50">
        <Sidebar 
          currentRole={currentRole} 
          onRoleChange={setCurrentRole}
          isOpen={sidebarOpen}
          onToggle={() => setSidebarOpen(!sidebarOpen)}
        />
        
        <div className={`flex-1 flex flex-col overflow-hidden transition-all duration-300 ${sidebarOpen ? 'ml-64' : 'ml-0'}`}>
          <header className="bg-white border-b border-gray-200 px-6 py-4">
            <div className="flex items-center justify-between">
              <div>
                <h1 className="text-2xl font-bold text-gray-800">
                  {currentRole === 'admin' && 'Dashboard Admin'}
                  {currentRole === 'student' && 'Dashboard Murid'}
                  {currentRole === 'teacher' && 'Dashboard Pengajar'}
                </h1>
                <p className="text-sm text-gray-500 mt-1">
                  Selamat datang di Sistem Les Privat Coding General
                </p>
              </div>
              <div className="flex items-center gap-4">
                <div className="text-right">
                  <p className="text-sm font-medium text-gray-700">
                    {currentRole === 'admin' && 'Admin User'}
                    {currentRole === 'student' && 'John Doe'}
                    {currentRole === 'teacher' && 'Jane Smith'}
                  </p>
                  <p className="text-xs text-gray-500">
                    {currentRole === 'admin' && 'Administrator'}
                    {currentRole === 'student' && 'Siswa'}
                    {currentRole === 'teacher' && 'Pengajar'}
                  </p>
                </div>
                <div className="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                  {currentRole === 'admin' && 'A'}
                  {currentRole === 'student' && 'J'}
                  {currentRole === 'teacher' && 'J'}
                </div>
              </div>
            </div>
          </header>

          <main className="flex-1 overflow-y-auto p-6">
            <Routes>
              {/* Admin Routes */}
              <Route path="/admin" element={<AdminDashboard />} />
              <Route path="/admin/accounts" element={<ManageAccounts />} />
              <Route path="/admin/packages" element={<ManagePackages />} />
              <Route path="/admin/purchases" element={<ManagePurchases />} />
              <Route path="/admin/schedules" element={<ManageSchedules />} />
              <Route path="/admin/attendance" element={<AttendanceHistory />} />

              {/* Student Routes */}
              <Route path="/student" element={<StudentDashboard />} />
              <Route path="/student/packages" element={<StudentPackages />} />
              <Route path="/student/schedule" element={<StudentSchedule />} />
              <Route path="/student/history" element={<StudentHistory />} />

              {/* Teacher Routes */}
              <Route path="/teacher" element={<TeacherDashboard />} />
              <Route path="/teacher/schedule" element={<TeacherSchedule />} />
              <Route path="/teacher/attendance" element={<TeacherAttendance />} />

              {/* Default redirect */}
              <Route path="/" element={<Navigate to={`/${currentRole}`} replace />} />
            </Routes>
          </main>
        </div>
      </div>
    </Router>
  );
}

export default App;
