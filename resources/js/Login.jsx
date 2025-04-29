import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Container,
  Box,
  Typography,
  TextField,
  Button,
  Grid,
  Link,
  Alert,
  CircularProgress,
  InputAdornment,
  FormControlLabel,
  Checkbox,
  Paper
} from '@mui/material';
import { Email, Lock } from '@mui/icons-material';
const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [rememberMe, setRememberMe] = useState(false);
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!email.trim() || !password.trim()) {
      setError('Veuillez remplir tous les champs');
      return;
    }

    setLoading(true);
    setError('');

    try {
      await new Promise(resolve => setTimeout(resolve, 1000));

      const isValid = (
        email.toLowerCase().trim() === 'admin@example.com' &&
        password.trim() === 'password'
      );

      if (isValid) {
        localStorage.setItem('isAuthenticated', 'true');
        if (rememberMe) {
          localStorage.setItem('rememberMe', 'true');
        }
        navigate('/dashboard');
      } else {
        setError('Email ou mot de passe incorrect');
      }
    } catch (err) {
      setError('Une erreur est survenue. Veuillez réessayer.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <Container maxWidth="xs" sx={{ height: '100vh', display: 'flex', alignItems: 'center' }}>
      <Paper elevation={3} sx={{ p: 4, width: '100%', borderRadius: 2 }}>
        {/* Logo + Titre */}
        <Box display="flex" justifyContent="center" alignItems="center" gap={1} mb={2}>
          <img
            src="/logo_icon.png"
            alt="FowlyCash Logo"
            style={{ width: 40, height: 40 }}
          />
          <Typography component="h1" variant="h5" sx={{ fontWeight: 'bold' }}>
            <span style={{
              fontWeight: 'bold',
              fontSize: '24px',
              color: '#1E88E5',
              fontFamily: 'Poppins, sans-serif'
            }}>
              Flowly<span style={{ color: '#43A047' }}>Cash</span>
            </span>
          </Typography>
        </Box>

        <Typography variant="body2" color="text.secondary" sx={{ mb: 3, textAlign: 'center' }}>
          Entrez vos identifiants pour accéder à votre compte
        </Typography>

        {error && (
          <Alert severity="error" sx={{ mb: 2 }}>
            {error}
          </Alert>
        )}

        <Box component="form" onSubmit={handleSubmit}>
          <TextField
            margin="normal"
            required
            fullWidth
            id="email"
            label="Adresse Email"
            name="email"
            autoComplete="email"
            autoFocus
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            InputProps={{
              startAdornment: (
                <InputAdornment position="start">
                  <Email color="action" />
                </InputAdornment>
              ),
            }}
            sx={{ mb: 2 }}
          />

          <TextField
            margin="normal"
            required
            fullWidth
            name="password"
            label="Mot de passe"
            type="password"
            id="password"
            autoComplete="current-password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            InputProps={{
              startAdornment: (
                <InputAdornment position="start">
                  <Lock color="action" />
                </InputAdornment>
              ),
            }}
            sx={{ mb: 1 }}
          />

          <FormControlLabel
            control={
              <Checkbox
                checked={rememberMe}
                onChange={(e) => setRememberMe(e.target.checked)}
                color="primary"
              />
            }
            label="Se souvenir de moi"
            sx={{ mb: 2 }}
          />

          <Button
            type="submit"
            fullWidth
            variant="contained"
            disabled={loading}
            sx={{
              mt: 1,
              mb: 2,
              py: 1.5,
              fontWeight: 'bold',
              bgcolor: 'primary.main',
              '&:hover': { bgcolor: 'primary.dark' }
            }}
          >
            {loading ? (
              <CircularProgress size={24} color="inherit" />
            ) : (
              'SE CONNECTER'
            )}
          </Button>

          <Grid container>
            <Grid item xs>
              <Link href="/forgot-password" variant="body2" underline="hover">
                Mot de passe oublié ?
              </Link>
            </Grid>
            <Grid item>
              <Link href="/register" variant="body2" underline="hover">
                Créer un compte
              </Link>
            </Grid>
          </Grid>
        </Box>

        <Box sx={{ mt: 3, textAlign: 'center' }}>
          <Typography variant="caption" color="text.secondary">
            Identifiants de test : admin@example.com / password
          </Typography>
        </Box>
      </Paper>
    </Container>
  );
};

export default Login;
