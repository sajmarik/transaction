import React, { useState, useEffect } from 'react';
import {
  Typography,
  Container,
  Grid,
  Card,
  CardContent,
  CardHeader,
  Avatar,
  IconButton,
  Chip,
  Divider,
  Button,
  Box,
  Skeleton
} from '@mui/material';
import {
  AccountBalance as AccountIcon,
  Add as AddIcon,
  Euro as EuroIcon,
  CreditCard as CardIcon,
  Savings as SavingsIcon,
  SwapHoriz as TransferIcon
} from '@mui/icons-material';
import { useNavigate } from 'react-router-dom';

// Données temporaires (à remplacer par un appel API)
const mockAccounts = [
  {
    id: 'acc1',
    name: 'Compte Courant',
    number: 'FR76 3000 4000 0100 1234 5678 900',
    balance: 5842.50,
    type: 'current',
    currency: 'EUR'
  },
  {
    id: 'acc2',
    name: 'Compte Épargne',
    number: 'FR76 3000 4000 0100 8765 4321 100',
    balance: 15200.00,
    type: 'savings',
    currency: 'EUR'
  },
  {
    id: 'acc3',
    name: 'Carte de Crédit',
    number: '•••• •••• •••• 1234',
    balance: -320.50,
    type: 'credit',
    currency: 'EUR'
  }
];

const Accounts = () => {
  const [accounts, setAccounts] = useState([]);
  const [loading, setLoading] = useState(true);
  const navigate = useNavigate();

  useEffect(() => {
    // Simulation de chargement API
    const timer = setTimeout(() => {
      setAccounts(mockAccounts);
      setLoading(false);
    }, 1000);

    return () => clearTimeout(timer);
  }, []);

  const getAccountIcon = (type) => {
    switch (type) {
      case 'savings': return <SavingsIcon />;
      case 'credit': return <CardIcon />;
      default: return <AccountIcon />;
    }
  };

  const handleTransfer = (accountId) => {
    navigate(`/transfers?from=${accountId}`);
  };

  const handleAddAccount = () => {
    // Logique pour ajouter un nouveau compte
    console.log('Ajouter un compte');
  };

  return (
    <Container maxWidth="lg" sx={{ py: 4 }}>
      <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', mb: 4 }}>
        <Typography variant="h4" component="h1">
          Mes Comptes
        </Typography>
        <Button
          variant="contained"
          startIcon={<AddIcon />}
          onClick={handleAddAccount}
        >
          Nouveau Compte
        </Button>
      </Box>

      <Divider sx={{ mb: 4 }} />

      {loading ? (
        <Grid container spacing={3}>
          {[1, 2, 3].map((item) => (
            <Grid item xs={12} sm={6} md={4} key={item}>
              <Skeleton variant="rectangular" height={180} />
            </Grid>
          ))}
        </Grid>
      ) : (
        <Grid container spacing={3}>
          {accounts.map((account) => (
            <Grid item xs={12} sm={6} md={4} key={account.id}>
              <Card
                sx={{
                  height: '100%',
                  display: 'flex',
                  flexDirection: 'column',
                  borderLeft: `4px solid ${
                    account.type === 'current' ? '#1976d2' :
                    account.type === 'savings' ? '#4caf50' : '#f44336'
                  }`
                }}
              >
                <CardHeader
                  avatar={
                    <Avatar sx={{ bgcolor: 'primary.main' }}>
                      {getAccountIcon(account.type)}
                    </Avatar>
                  }
                  title={account.name}
                  subheader={account.number}
                  action={
                    <Chip
                      label={account.type === 'current' ? 'Courant' :
                            account.type === 'savings' ? 'Épargne' : 'Crédit'}
                      size="small"
                      color={account.type === 'credit' ? 'error' : 'primary'}
                    />
                  }
                />
                <CardContent sx={{ flexGrow: 1 }}>
                  <Typography variant="h5" component="div" sx={{ mb: 1 }}>
                    <Box
                      component="span"
                      sx={{
                        color: account.balance >= 0 ? 'success.main' : 'error.main',
                        display: 'flex',
                        alignItems: 'center'
                      }}
                    >
                      <EuroIcon sx={{ mr: 1, fontSize: 'inherit' }} />
                      {account.balance.toLocaleString('fr-FR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                      })}
                    </Box>
                  </Typography>
                </CardContent>
                <Box sx={{ p: 2, display: 'flex', justifyContent: 'flex-end' }}>
                  <IconButton
                    color="primary"
                    aria-label="Faire un virement"
                    onClick={() => handleTransfer(account.id)}
                  >
                    <TransferIcon />
                  </IconButton>
                </Box>
              </Card>
            </Grid>
          ))}
        </Grid>
      )}

      {/* Section du solde total */}
      {!loading && (
        <Box sx={{ mt: 4, p: 3, bgcolor: 'background.paper', borderRadius: 1 }}>
          <Typography variant="h6" gutterBottom>
            Solde Global
          </Typography>
          <Typography variant="h4" color="primary">
            {accounts
              .reduce((total, acc) => total + acc.balance, 0)
              .toLocaleString('fr-FR', {
                style: 'currency',
                currency: 'EUR',
                minimumFractionDigits: 2
              })}
          </Typography>
        </Box>
      )}
    </Container>
  );
};

export default Accounts;