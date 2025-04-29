import React from 'react';
import {
  List,
  ListItem,
  ListItemIcon,
  ListItemText,
  Divider,
  Typography,
  Box,
  CssBaseline
} from '@mui/material';
import { Link, useLocation } from 'react-router-dom';
import {
  Dashboard as DashboardIcon,
  AccountBalance as AccountBalanceIcon,
  Timeline as TimelineIcon,
  CalendarToday as CalendarTodayIcon,
  AccountTree as AccountTreeIcon,
  Assessment as AssessmentIcon,
  Settings as SettingsIcon,
  Send as SendIcon,
  Receipt as ReceiptIcon
} from '@mui/icons-material';

const Sidebar = () => {
  const location = useLocation();

  const menuItems = [
    { text: 'Tableau de bord', icon: <DashboardIcon />, path: '/dashboard' },
    { text: 'Flux financiers', icon: <AccountBalanceIcon />, path: '/flux' },
    { text: 'Prévisions', icon: <TimelineIcon />, path: '/previsions' },
    { text: 'Échéances', icon: <CalendarTodayIcon />, path: '/echeances' },
    { text: 'Comptes', icon: <AccountTreeIcon />, path: '/comptes' },
    { text: 'Transactions', icon: <ReceiptIcon />, path: '/transactionform' },
    { text: 'Transferts', icon: <SendIcon />, path: '/transferform' },
    { text: 'Rapports', icon: <AssessmentIcon />, path: '/rapports' },
    { text: 'Paramètres', icon: <SettingsIcon />, path: '/parametres' }
  ];

  return (
    <>
      <CssBaseline />
      <Box 
        sx={{ 
          width: 250,
          height: '100vh',
          position: 'fixed',
          left: 0,
          top: 0,
          bgcolor: 'background.paper',
          boxShadow: 3,
          zIndex: 1,
          display: 'flex',
          flexDirection: 'column'
        }}
      >
        {/* En-tête */}
        <Box 
          sx={{ 
            p: 3, 
            textAlign: 'center',
            bgcolor: '#0d47a1',
            color: 'white'
          }}
        >
          <Typography 
            variant="h5" 
            sx={{ 
              fontWeight: 'bold',
              letterSpacing: '1px',
              background: 'linear-gradient(45deg, #ffffff, #43A047)',
              WebkitBackgroundClip: 'text',
              WebkitTextFillColor: 'transparent'
            }}
          >
            FlowlyCash
          </Typography>
        </Box>

        {/* Menu défilable */}
        <Box sx={{ overflowY: 'auto', flexGrow: 1 }}>
          <List>
            {menuItems.map((item) => (
              <ListItem
                button
                key={item.text}
                component={Link}
                to={item.path}
                selected={location.pathname === item.path}
                sx={{
                  '&.Mui-selected': {
                    bgcolor: 'primary.main',
                    color: 'white',
                    '& .MuiListItemIcon-root': {
                      color: 'white'
                    }
                  },
                  '&:hover': {
                    bgcolor: 'primary.light',
                    color: 'white'
                  }
                }}
              >
                <ListItemIcon sx={{ color: 'inherit' }}>
                  {item.icon}
                </ListItemIcon>
                <ListItemText 
                  primary={item.text} 
                  primaryTypographyProps={{ fontWeight: 'medium' }}
                />
              </ListItem>
            ))}
          </List>
        </Box>

        {/* Pied de sidebar (optionnel) */}
        <Box sx={{ p: 2, bgcolor: 'grey.100' }}>
          <Typography variant="body2" color="text.secondary" align="center">
            Version 1.0.0
          </Typography>
        </Box>
      </Box>

      {/* Espace pour le contenu principal */}
      <Box component="main" sx={{ ml: 30 }}>
        {/* Votre contenu ira ici */}
      </Box>
    </>
  );
};

export default Sidebar;