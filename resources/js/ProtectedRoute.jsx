import { Navigate, Outlet } from 'react-router-dom';

const ProtectedRoute = () => {
  return localStorage.getItem('isAuthenticated') 
    ? <Outlet /> 
    : <Navigate to="/login" replace />;
};

export default ProtectedRoute;