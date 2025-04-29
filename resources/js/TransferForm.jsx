import React, { useState } from 'react';
import {
  Box,
  Typography,
  TextField,
  MenuItem,
  Button,
  Grid,
  Paper,
  InputAdornment,
  Divider,
  Container
} from '@mui/material';
import { DatePicker } from '@mui/x-date-pickers/DatePicker';
import SendIcon from '@mui/icons-material/Send';
import dayjs from 'dayjs';

const TransferForm = () => {
  const [formData, setFormData] = useState({
    sourceAccount: '',
    destinationAccount: '',
    amount: '',
    transferDate: dayjs(),
    reference: '',
    frequency: 'single'
  });

  const accounts = [
    { id: 'acc1', name: 'Compte Courant - BCP', balance: 24580.00 },
    { id: 'acc2', name: 'Compte Épargne - SG', balance: 150000.00 },
    { id: 'acc3', name: 'Compte Pro - CIH', balance: 85000.00 }
  ];

  const frequencies = [
    { value: 'single', label: 'Ponctuel' },
    { value: 'monthly', label: 'Mensuel' },
    { value: 'quarterly', label: 'Trimestriel' }
  ];

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('Transfert soumis:', formData);
  };

  return (
    <Container maxWidth="lg" sx={{ py: 4 }}>
      <Paper elevation={3} sx={{ p: 4, width: '100%' }}>
        <Box sx={{ display: 'flex', alignItems: 'center', mb: 3 }}>
          <SendIcon color="primary" sx={{ mr: 1, fontSize: 32 }} />
          <Typography variant="h4" component="h1">
            Nouveau Transfert
          </Typography>
        </Box>
        <Divider sx={{ mb: 4 }} />

        <form onSubmit={handleSubmit}>
          <Grid container spacing={4}>
            {/* Compte Source */}
            <Grid item xs={12} md={6}>
              <TextField
                select
                fullWidth
                label="Compte Source"
                name="sourceAccount"
                value={formData.sourceAccount}
                onChange={handleChange}
                required
                size="medium"
                InputLabelProps={{ shrink: true }}
              >
                {accounts.map(account => (
                  <MenuItem key={account.id} value={account.id}>
                    <Box>
                      <Typography>{account.name}</Typography>
                      <Typography variant="body2" color="text.secondary">
                        Solde: {account.balance.toLocaleString()} MAD
                      </Typography>
                    </Box>
                  </MenuItem>
                ))}
              </TextField>
            </Grid>

            {/* Compte Destination */}
            <Grid item xs={12} md={6}>
              <TextField
                select
                fullWidth
                label="Compte Destination"
                name="destinationAccount"
                value={formData.destinationAccount}
                onChange={handleChange}
                required
                size="medium"
                InputLabelProps={{ shrink: true }}
              >
                {accounts.filter(acc => acc.id !== formData.sourceAccount).map(account => (
                  <MenuItem key={account.id} value={account.id}>
                    {account.name}
                  </MenuItem>
                ))}
              </TextField>
            </Grid>

            {/* Montant */}
            <Grid item xs={12} md={4}>
              <TextField
                fullWidth
                label="Montant"
                name="amount"
                type="number"
                value={formData.amount}
                onChange={handleChange}
                InputProps={{
                  endAdornment: <InputAdornment position="end">MAD</InputAdornment>,
                  inputProps: { min: 1 }
                }}
                required
                size="medium"
              />
            </Grid>

            {/* Date */}
            <Grid item xs={12} md={4}>
              <DatePicker
                label="Date de Transfert"
                value={formData.transferDate}
                onChange={(newValue) => setFormData({...formData, transferDate: newValue})}
                renderInput={(params) => (
                  <TextField 
                    {...params} 
                    fullWidth 
                    required 
                    size="medium"
                    InputLabelProps={{ shrink: true }}
                  />
                )}
              />
            </Grid>

            {/* Fréquence */}
            <Grid item xs={12} md={4}>
              <TextField
                select
                fullWidth
                label="Type de Transfert"
                name="frequency"
                value={formData.frequency}
                onChange={handleChange}
                size="medium"
                InputLabelProps={{ shrink: true }}
              >
                {frequencies.map(option => (
                  <MenuItem key={option.value} value={option.value}>
                    {option.label}
                  </MenuItem>
                ))}
              </TextField>
            </Grid>

            {/* Référence */}
            <Grid item xs={12}>
              <TextField
                fullWidth
                label="Référence"
                name="reference"
                value={formData.reference}
                onChange={handleChange}
                placeholder="Ex: Virement salaire Mars"
                size="medium"
                InputLabelProps={{ shrink: true }}
              />
            </Grid>

            {/* Bouton Soumettre */}
            <Grid item xs={12}>
              <Button
                type="submit"
                variant="contained"
                size="large"
                fullWidth
                startIcon={<SendIcon />}
                sx={{ 
                  py: 2,
                  fontSize: '1.1rem',
                  fontWeight: 'bold'
                }}
              >
                Exécuter le Transfert
              </Button>
            </Grid>
          </Grid>
        </form>
      </Paper>
    </Container>
  );
};

export default TransferForm;
