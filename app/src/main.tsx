import React from 'react'
import ReactDOM from 'react-dom/client'
import { BrowserRouter } from 'react-router-dom'

import * as Components from './components'
import { ListBillingProvider } from './contexts/billings'

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    <BrowserRouter>
      <ListBillingProvider>
        <Components.App/>
      </ListBillingProvider>
    </BrowserRouter>
  </React.StrictMode>,
)
