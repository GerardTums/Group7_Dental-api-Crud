import { Box, Button, TextField, Typography } from '@mui/material'
import React from 'react'
import { Link } from 'react-router-dom'

export default function Login() {
  return (
    <Box sx={{minHeight: '100vh', display: 'flex', justifyContent: 'center', alignItems: 'center'}}>
        <Box sx={{height: 250, width: 500, boxShadow: 'black 0px 0px 20px', borderRadius: 2}}>
            <Typography variant="h4" sx={{textAlign: 'center', mt: 2}}>
                Login

            </Typography>
            <Box sx={{width: 300, mx: 'auto'}}>
                <Box sx={{mt: 1}}>
                    <TextField fullWidth size="small" label="Username" />
                </Box>
                <Box sx={{mt: 1}}>
                    <TextField fullWidth size="small" label="Password" type="password"/>
                </Box>
                <Box sx={{mt: 1, textAlign: 'center'}}>
                    <Button variant="contained">Login</Button>
                </Box>
            </Box>
            <Box sx={{mt: 2, textAlign: 'center'}}>
            <Link to="/register">
                <Typography>
                    Don't Have an account yet?

                </Typography>
            </Link> 
            </Box>
        </Box>
    </Box>
  )
}
