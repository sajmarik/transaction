// Exemple basique (à adapter)
import { TextField, Button } from '@mui/material';

const Register = () => {
  return (
    <form>
      <TextField label="Nom complet" fullWidth margin="normal" />
      <TextField label="Email" type="email" fullWidth margin="normal" />
      <TextField label="Mot de passe" type="password" fullWidth margin="normal" />
      <Button type="submit" variant="contained" fullWidth>
        S'inscrire
      </Button>
    </form>
  );
};