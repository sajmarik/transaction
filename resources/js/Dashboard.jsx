import React from 'react';
import {
  Box,
  Typography,
  Paper,
  Grid,
  Divider,
  useTheme,
  Button,
  List,
  ListItem,
  ListItemButton,
  ListItemIcon,
  ListItemText,
  CssBaseline
} from '@mui/material';
import {
  ArrowUpward as ArrowUpwardIcon,
  ArrowDownward as ArrowDownwardIcon,
  AccountBalance as AccountBalanceIcon,
  MonetizationOn as MonetizationOnIcon,
  PieChart as PieChartIcon,
  BarChart as BarChartIcon,
  
} from '@mui/icons-material';
import { Doughnut, Bar } from 'react-chartjs-2';
import { Chart as ChartJS, registerables } from 'chart.js';

ChartJS.register(...registerables);


const Dashboard = () => {
  const theme = useTheme();

  // Données pour les graphiques
  const revenueExpenseData = {
    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
    datasets: [
      {
        label: 'Revenus',
        data: [80000, 95000, 100000, 105000, 110000, 125000],
        backgroundColor: theme.palette.success.light,
      },
      {
        label: 'Dépenses',
        data: [70000, 80000, 85000, 90000, 92000, 95000],
        backgroundColor: theme.palette.error.light,
      },
    ],
  };

  const expenseDistributionData = {
    labels: ['Personnel', 'Fournitures', 'Logiciels', 'Loyer', 'Divers'],
    datasets: [
      {
        data: [35, 25, 20, 15, 5],
        backgroundColor: [
          theme.palette.primary.main,
          theme.palette.secondary.main,
          theme.palette.error.main,
          theme.palette.warning.main,
          theme.palette.info.main,
        ],
      },
    ],
  };

  // Cartes de métriques
  const metrics = [
    {
      title: 'Revenus totaux',
      value: '1 250 000 MAD',
      change: 12.5,
      icon: <MonetizationOnIcon fontSize="large" />,
      color: 'success'
    },
    {
      title: 'Dépenses totales',
      value: '950 000 MAD',
      change: 8.1,
      icon: <AccountBalanceIcon fontSize="large" />,
      color: 'error'
    },
    {
      title: 'Trésorerie nette',
      value: '300 000 MAD',
      change: 25.3,
      icon: <PieChartIcon fontSize="large" />,
      color: 'primary'
    }
  ];

  return (
    <Box sx={{ display: 'flex',minHeight: '100vh' }}>
      <CssBaseline />
      
      
      {/* Contenu principal */}
      <Box component="main" sx={{ 
        flexGrow: 1,
        p: 4,

        width: 'calc(100% - 250px)'
      }}>
        <Typography variant="h4" gutterBottom sx={{ mb: 4 }}>
          Tableau de bord financier
        </Typography>

        {/* Cartes de métriques */}
        <Grid container spacing={3} sx={{ mb: 4 }}>
          {metrics.map((metric, index) => (
            <Grid item xs={12} md={4} key={index}>
             <Paper elevation={3} sx={{ 
        p: 3, 
        borderRadius: 2,
        height: '100%',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'space-between'
      }}>
                <Box sx={{ display: 'flex', justifyContent: 'space-between' }}>
                  <Box>
                    <Typography variant="h6" color="text.secondary">
                      {metric.title}
                    </Typography>
                    <Typography variant="h5" sx={{ mt: 1 }}>
                      {metric.value}
                    </Typography>
                    <Box sx={{ display: 'flex', alignItems: 'center', mt: 1 }}>
                      {metric.change > 0 ? (
                        <ArrowUpwardIcon color={metric.color} />
                      ) : (
                        <ArrowDownwardIcon color="error" />
                      )}
                      <Typography
                        variant="body2"
                        color={metric.change > 0 ? 'success.main' : 'error.main'}
                        sx={{ ml: 0.5 }}
                      >
                        {metric.change}% vs mois dernier
                      </Typography>
                    </Box>
                  </Box>
                  <Box sx={{ color: `${metric.color}.main` }}>
                    {metric.icon}
                  </Box>
                </Box>
              </Paper>
            </Grid>
          ))}
        </Grid>

        <Grid container spacing={3}>
          {/* Graphique revenus vs dépenses */}
          <Grid item xs={12} md={8}>
            <Paper elevation={3} sx={{ p: 3, borderRadius: 2, height: '100%' }}>
              <Box sx={{ display: 'flex', alignItems: 'center', mb: 3 }}>
                <BarChartIcon color="primary" sx={{ mr: 1 }} />
                <Typography variant="h6">Revenus vs Dépenses</Typography>
              </Box>
              <Box sx={{ height: 300 }}>
                <Bar
                  data={revenueExpenseData}
                  options={{
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }}
                />
              </Box>
            </Paper>
          </Grid>

          {/* Graphique répartition des dépenses */}
          <Grid item xs={12} md={4}>
            <Paper elevation={3} sx={{ p: 3, borderRadius: 2, height: '100%' }}>
              <Box sx={{ display: 'flex', alignItems: 'center', mb: 3 }}>
                <PieChartIcon color="secondary" sx={{ mr: 1 }} />
                <Typography variant="h6">Répartition des dépenses</Typography>
              </Box>
              <Box sx={{ height: 300 }}>
                <Doughnut
                  data={expenseDistributionData}
                  options={{
                    responsive: true,
                    maintainAspectRatio: false,
                  }}
                />
              </Box>
            </Paper>
          </Grid>
        </Grid>
      </Box>
    </Box>
  );
};

export default Dashboard;