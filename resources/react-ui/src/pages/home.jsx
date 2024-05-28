import { Box, Typography } from '@mui/material'
import React from 'react'
import { useSelector } from 'react-redux'
import checkAuth from '../hoc/checkAuth'

function home() {
  const user = useSelector(state => state.auth.user)
  return (
    <Box>
        <Typography variant="h1">Hello, Guest</Typography>
    </Box>
  )
}

export default checkAuth(home)