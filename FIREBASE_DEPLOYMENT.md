# Firebase Deployment Guide for RCF Church Website

## ⚠️ IMPORTANT: PHP Compatibility

Your website uses PHP files (admin_dashboard.php, index.php, etc.) which **will NOT work on Firebase Hosting** (static only).

### What WILL Deploy to Firebase:
✅ HTML files
✅ CSS files  
✅ JavaScript files
✅ Images (PNG, JPG, etc.)
✅ Videos (MOV, MP4, WebM, etc.)
✅ Manifest files & other static assets

### What WON'T Work on Firebase:
❌ PHP files (admin_dashboard.php, index.php database functions)
❌ MySQL database connections
❌ Admin login/settings system

---

## Solution Options:

### Option A: Static Only (Quick Deploy)
Deploy just the frontend to Firebase. Admin features will be disabled.
- Convert `index.php` to `index.html` 
- Remove PHP/database functionality
- All videos & static content works normally

### Option B: Hybrid Setup (Recommended)
- Deploy frontend to Firebase Hosting
- Use Firebase Cloud Functions for backend (replaces PHP)
- Use Firestore database (replaces MySQL)
- Keep full admin functionality

### Option C: Keep Original Setup
- Keep on XAMPP locally
- Or move to traditional PHP hosting (Bluehost, HostGator, etc.)

---

## Quick Start (Option A - Static Only)

### Step 1: Install Node.js
1. Download from https://nodejs.org/ (LTS version)
2. Run installer with admin rights
3. Verify: Open PowerShell and run `node --version`

### Step 2: Install Firebase CLI
```powershell
npm install -g firebase-tools
```

### Step 3: Login to Firebase
```powershell
firebase login
```
This opens a browser to authenticate your Google account.

### Step 4: Initialize Firebase Project (One Time)
```powershell
cd c:\xampp\htdocs\rcfchurch
firebase init hosting
```
When prompted:
- **What do you want to use for your public directory?** → Answer: `.` (current directory)
- **Configure as SPA?** → Answer: `y` (yes)
- **Overwrite firebase.json?** → Answer: `n` (no - we already have it)

### Step 5: Create Firebase Project
1. Go to https://console.firebase.google.com/
2. Click "Create Project"
3. Name it: `rcf-church-masindi`
4. Enable Google Analytics (optional)
5. Create project

### Step 6: Update .firebaserc
Edit `.firebaserc` file and replace `YOUR-PROJECT-ID-HERE` with your actual project ID (shown in Firebase Console).

Example:
```json
{
  "projects": {
    "default": "rcf-church-masindi-abc123"
  }
}
```

### Step 7: Deploy! 🚀
```powershell
firebase deploy
```

Your site will be live at: `https://rcf-church-masindi.web.app`

---

## File Structure After Deploy

Your Firebase hosting will include:
```
rcfchurch/
├── index.html (use static version, not index.php)
├── style.css ✅
├── script.js ✅
├── manifest.json ✅
├── iphone/ (all your videos) ✅
├── img/ ✅
├── dashboard/ ✅
└── ... (all static files)
```

---

## Troubleshooting

**"firebase command not found"**
- Make sure Node.js is installed: `node --version`
- Close PowerShell and reopen after Node.js install

**"Public directory not found"**
- Make sure you're in the `rcfchurch` folder before running `firebase init`

**Videos not loading**
- Check that `iphone/` folder is in the deployment
- Videos should be accessible at: `https://your-site.web.app/iphone/IMG_4062.MOV`

---

## Next Steps (After Deploy)

1. **Verify live site:** Open in browser and test all features
2. **Migrate backend:** If you want admin dashboard on Firebase, set up Cloud Functions + Firestore
3. **Custom domain:** Set up custom domain in Firebase Console

---

## Support Links
- Firebase Docs: https://firebase.google.com/docs/hosting
- Firebase Console: https://console.firebase.google.com/
- Firebase CLI: https://firebase.google.com/docs/cli

**Ready? Once Node.js is installed:**
1. Open PowerShell in admin mode
2. Run: `npm install -g firebase-tools`
3. Return and I'll help with the rest! 🚀
