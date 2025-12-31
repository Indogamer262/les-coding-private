import { Link, useLocation } from 'react-router-dom';
import { LayoutDashboard, Users, Package, ShoppingCart, Calendar, History, BookOpen, ClipboardCheck, Menu, X } from 'lucide-react';

type UserRole = 'admin' | 'student' | 'teacher';

interface SidebarProps {
  currentRole: UserRole;
  onRoleChange: (role: UserRole) => void;
  isOpen: boolean;
  onToggle: () => void;
}

export function Sidebar({ currentRole, onRoleChange, isOpen, onToggle }: SidebarProps) {
  const location = useLocation();

  const adminMenuItems = [
    { path: '/admin', icon: LayoutDashboard, label: 'Dashboard' },
    { path: '/admin/accounts', icon: Users, label: 'Kelola Akun' },
    { path: '/admin/packages', icon: Package, label: 'Kelola Paket' },
    { path: '/admin/purchases', icon: ShoppingCart, label: 'Kelola Pembelian' },
    { path: '/admin/schedules', icon: Calendar, label: 'Kelola Jadwal' },
    { path: '/admin/attendance', icon: History, label: 'Riwayat Kehadiran' },
  ];

  const studentMenuItems = [
    { path: '/student', icon: LayoutDashboard, label: 'Dashboard' },
    { path: '/student/packages', icon: Package, label: 'Paket Saya' },
    { path: '/student/schedule', icon: Calendar, label: 'Jadwal Les' },
    { path: '/student/history', icon: History, label: 'Riwayat Pertemuan' },
  ];

  const teacherMenuItems = [
    { path: '/teacher', icon: LayoutDashboard, label: 'Dashboard' },
    { path: '/teacher/schedule', icon: Calendar, label: 'Jadwal Mengajar' },
    { path: '/teacher/attendance', icon: ClipboardCheck, label: 'Isi Kehadiran' },
  ];

  const menuItems = 
    currentRole === 'admin' ? adminMenuItems :
    currentRole === 'student' ? studentMenuItems :
    teacherMenuItems;

  return (
    <>
      <button
        onClick={onToggle}
        className="fixed top-4 left-4 z-50 p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
      >
        {isOpen ? <X size={20} /> : <Menu size={20} />}
      </button>

      <aside className={`fixed left-0 top-0 h-full w-64 bg-blue-900 text-white transition-transform duration-300 z-40 ${isOpen ? 'translate-x-0' : '-translate-x-full'}`}>
        <div className="p-6">
          <div className="flex items-center gap-2 mb-8">
            <BookOpen size={32} className="text-blue-300" />
            <div>
              <h2 className="text-xl font-bold">Les Coding</h2>
              <p className="text-xs text-blue-300">General System</p>
            </div>
          </div>

          {/* Role Switcher - For Demo Purpose */}
          <div className="mb-6 p-3 bg-blue-800 rounded-lg">
            <p className="text-xs text-blue-300 mb-2">Switch Role (Demo):</p>
            <div className="flex flex-col gap-2">
              <button
                onClick={() => onRoleChange('admin')}
                className={`px-3 py-2 rounded text-sm transition-colors ${
                  currentRole === 'admin' ? 'bg-blue-600' : 'bg-blue-700 hover:bg-blue-600'
                }`}
              >
                Admin
              </button>
              <button
                onClick={() => onRoleChange('student')}
                className={`px-3 py-2 rounded text-sm transition-colors ${
                  currentRole === 'student' ? 'bg-blue-600' : 'bg-blue-700 hover:bg-blue-600'
                }`}
              >
                Murid
              </button>
              <button
                onClick={() => onRoleChange('teacher')}
                className={`px-3 py-2 rounded text-sm transition-colors ${
                  currentRole === 'teacher' ? 'bg-blue-600' : 'bg-blue-700 hover:bg-blue-600'
                }`}
              >
                Pengajar
              </button>
            </div>
          </div>

          <nav className="space-y-1">
            {menuItems.map((item) => {
              const Icon = item.icon;
              const isActive = location.pathname === item.path;
              
              return (
                <Link
                  key={item.path}
                  to={item.path}
                  className={`flex items-center gap-3 px-4 py-3 rounded-lg transition-colors ${
                    isActive 
                      ? 'bg-blue-700 text-white' 
                      : 'text-blue-100 hover:bg-blue-800'
                  }`}
                >
                  <Icon size={20} />
                  <span className="text-sm font-medium">{item.label}</span>
                </Link>
              );
            })}
          </nav>
        </div>
      </aside>
    </>
  );
}
