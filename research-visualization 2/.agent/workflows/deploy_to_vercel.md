---
description: Deploy the application to Vercel
---

# Deploy to Vercel

1.  **Login to Vercel** (if not already logged in):
    ```bash
    npx vercel login
    ```

2.  **Deploy**:
    Run the following command to deploy your project. Follow the interactive prompts (select scope, link to existing project or create new, etc.).
    ```bash
    npx vercel
    ```
    - Set the **Output Directory** to `dist` if asked (Vite default).
    - If it asks to modify build settings, the defaults for Vite (`vite build`) are usually correct.

3.  **Production Deployment**:
    Once you have tested the preview deployment, deploy to production:
    ```bash
    npx vercel --prod
    ```
