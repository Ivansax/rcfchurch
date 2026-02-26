# Auto-Deploy Setup: GitHub + Firebase

Your project is now configured for **automatic deployment**! Here's how it works:

## 🚀 How It Works

1. You make changes locally
2. Push to GitHub (`git push`)
3. GitHub Actions automatically deploys to Firebase
4. Your live site updates instantly!

---

## ⚙️ Setup Instructions (One-Time Only)

### Step 1: Generate Firebase Service Account Key

1. Go to: https://console.firebase.google.com/
2. Select your project: **rcfchurch-8655f**
3. Click **Settings** (gear icon) → **Project Settings**
4. Go to the **Service Accounts** tab
5. Click **Generate New Private Key**
6. Save the JSON file (keep it secret!)

### Step 2: Add to GitHub Secrets

1. Go to your GitHub repo: https://github.com/Ivansax/rcfchurch
2. Click **Settings** → **Secrets and variables** → **Actions**
3. Click **New repository secret**
4. **Name:** `FIREBASE_SERVICE_ACCOUNT_RCFCHURCH_8655F`
5. **Value:** Paste the entire JSON content from the file you downloaded
6. Click **Add secret**

### Step 3: Initial Deployment

First deployment must be done manually:

```powershell
cd c:\xampp\htdocs\rcfchurch
firebase deploy
```

### Step 4: Push to GitHub

```powershell
git add .
git commit -m "Set up Firebase auto-deploy"
git push origin main
```

---

## ✅ Testing the Auto-Deploy

1. Make a small change to `index.html` (add a comment)
2. Run:
   ```powershell
   git add .
   git commit -m "Test auto-deploy"
   git push origin main
   ```
3. Check GitHub Actions: https://github.com/Ivansax/rcfchurch/actions
4. Watch the deployment happen automatically!
5. Refresh your Firebase site (https://rcfchurch-8655f.web.app) to see changes

---

## 📋 Workflow File

The file `.github/workflows/firebase-deploy.yml` automatically:
- Triggers on every push to `main` or `master`
- Runs the Firebase deployment
- Updates your live site

---

## 🎯 From Now On

Every time you:
```powershell
git push
```

Your Firebase site updates automatically! No more manual `firebase deploy` needed! ✨

---

## Troubleshooting

**"Action failed with error..."**
- Check if the service account secret was added correctly
- See the error in GitHub Actions tab

**"Deploy not triggering"**
- Make sure you're pushing to `main` or `master` branch
- Check GitHub Actions tab for logs

---

Let me know once you've set up the Firebase Service Account Key! 🔑
