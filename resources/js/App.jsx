import { createRoot } from 'react-dom/client';
import React from 'react';
import { ThemeProvider, createTheme } from '@mui/material';
import { BrowserRouter, Routes, Route, Navigate, Outlet } from 'react-router-dom'; // Ajout d'Outlet
import { LocalizationProvider } from '@mui/x-date-pickers';
import { AdapterDayjs } from '@mui/x-date-pickers/AdapterDayjs';

import Login from './components/auth/Login';
import Dashboard from './pages/Dashboard';
import Sidebar from './components/Sidebar';
import ProtectedRoute from './components/ProtectedRoute';
import Test from './pages/test';
import TransferForm from './pages/TransferForm';
import TransactionForm from './pages/TransactionForm';

const theme = createTheme({
  palette: {
    primary: { main: '#1976d2' },
  },
});

// Nouveau Layout avec Outlet
const Layout = () => (
  <div style={{ display: 'flex', minHeight: '100vh' }}>
    {/* Sidebar fixe */}
    <div style={{ width: '240px', flexShrink: 0 }}>
      <Sidebar />
    </div>
    
    {/* Contenu principal */}
    <div style={{ 
      flexGrow: 1, 
      padding: '20px',
      overflowY: 'auto' // Permet le scroll si le contenu est long
    }}>
      <Outlet /> {/* Remplace Dashboard */}
    </div>
  </div>
);

export default function App() {
  return (
    <LocalizationProvider dateAdapter={AdapterDayjs}>
      <ThemeProvider theme={theme}>
        <BrowserRouter>
          <Routes>
            <Route path="/login" element={<Login />} />
            
            {/* Routes protégées */}
            <Route element={<ProtectedRoute />}>
              <Route element={<Layout />}> {/* Layout appliqué ici */}
                <Route path="/dashboard" element={<Dashboard />} />
                <Route path="/test" element={<Test />} />
                <Route path="/transferform" element={<TransferForm />} />
                <Route path="/transactionform" element={<TransactionForm/>} />
              </Route>
            </Route>

            {/* Redirection */}
            <Route path="*" element={<Navigate to="/login" replace />} />
          </Routes>
        </BrowserRouter>
      </ThemeProvider>
    </LocalizationProvider>
  );
}

if (document.getElementById('app')) {
  createRoot(document.getElementById('app')).render(<App />);
}