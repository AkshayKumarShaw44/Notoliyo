# 🚀 Vercel Deployment Guide for Notoliyo

## 📋 Prerequisites

Before deploying to Vercel, ensure you have:
- ✅ A GitHub account
- ✅ A Vercel account (sign up at https://vercel.com)
- ✅ MongoDB Atlas account (for production database)
- ✅ Your project pushed to GitHub

---

## 🗄️ Step 1: Set Up MongoDB Atlas (Production Database)

### 1.1 Create MongoDB Atlas Account
1. Go to https://www.mongodb.com/cloud/atlas
2. Sign up for a free account
3. Create a new cluster (Free tier is sufficient)

### 1.2 Configure Database Access
1. In MongoDB Atlas dashboard, go to **Database Access**
2. Click **Add New Database User**
3. Create a username and strong password (save these!)
4. Set privileges to **Read and write to any database**

### 1.3 Configure Network Access
1. Go to **Network Access**
2. Click **Add IP Address**
3. Click **Allow Access from Anywhere** (0.0.0.0/0)
4. Confirm

### 1.4 Get Connection String
1. Go to **Database** → **Connect**
2. Choose **Connect your application**
3. Copy the connection string (looks like):
   ```
   mongodb+srv://<username>:<password>@cluster0.xxxxx.mongodb.net/?retryWrites=true&w=majority
   ```
4. Replace `<username>` and `<password>` with your credentials
5. Add your database name after `.net/`: 
   ```
   mongodb+srv://username:password@cluster0.xxxxx.mongodb.net/notoliyo?retryWrites=true&w=majority
   ```

---

## 📦 Step 2: Prepare Your Project

### 2.1 Update .gitignore (Already Done)
Ensure these files are in `.gitignore`:
```
/vendor
/node_modules
.env
.env.backup
/public/hot
/public/storage
/storage/*.key
```

### 2.2 Build Production Assets
```bash
npm run build
```

### 2.3 Commit All Changes
```bash
git add .
git commit -m "Prepare for Vercel deployment"
git push origin main
```

---

## 🌐 Step 3: Deploy to Vercel

### 3.1 Import Project to Vercel
1. Go to https://vercel.com/dashboard
2. Click **Add New** → **Project**
3. Import your GitHub repository
4. Select the **Notoliyo** repository

### 3.2 Configure Build Settings
Vercel should auto-detect the settings, but verify:
- **Framework Preset**: Other
- **Build Command**: `composer install --no-dev --optimize-autoloader && npm install && npm run build`
- **Output Directory**: `public`
- **Install Command**: Leave empty

### 3.3 Add Environment Variables
Click **Environment Variables** and add these:

#### Required Variables:
```env
APP_NAME=Notoliyo
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.vercel.app

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mongodb
DB_HOST=cluster0.xxxxx.mongodb.net
DB_PORT=27017
DB_DATABASE=notoliyo
DB_USERNAME=your_mongodb_username
DB_PASSWORD=your_mongodb_password

MONGODB_DSN=mongodb+srv://username:password@cluster0.xxxxx.mongodb.net/notoliyo?retryWrites=true&w=majority

SESSION_DRIVER=cookie
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

CACHE_STORE=file
CACHE_PREFIX=

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

#### How to Get APP_KEY:
Run this locally:
```bash
php artisan key:generate --show
```
Copy the output (including `base64:`) and paste it as `APP_KEY` value.

### 3.4 Deploy
1. Click **Deploy**
2. Wait for the build to complete (3-5 minutes)
3. Once deployed, you'll get a URL like: `https://notoliyo.vercel.app`

---

## ⚙️ Step 4: Post-Deployment Configuration

### 4.1 Update APP_URL
1. Go to Vercel Dashboard → Your Project → **Settings** → **Environment Variables**
2. Update `APP_URL` with your actual Vercel URL
3. Redeploy the project

### 4.2 Test Your Application
Visit your Vercel URL and test:
- ✅ Landing page loads
- ✅ Registration works
- ✅ Login works
- ✅ Dashboard displays
- ✅ Create notes
- ✅ All features work

---

## 🔧 Step 5: Custom Domain (Optional)

### 5.1 Add Custom Domain
1. Go to Vercel Dashboard → Your Project → **Settings** → **Domains**
2. Click **Add Domain**
3. Enter your domain (e.g., `notoliyo.com`)
4. Follow Vercel's instructions to update DNS records

### 5.2 Update Environment Variables
Update `APP_URL` to your custom domain:
```env
APP_URL=https://notoliyo.com
```

---

## 🐛 Troubleshooting

### Issue: 500 Internal Server Error
**Solution:**
1. Check Vercel logs: Dashboard → Your Project → **Deployments** → Click deployment → **Function Logs**
2. Ensure `APP_KEY` is set correctly
3. Verify MongoDB connection string is correct

### Issue: Assets Not Loading
**Solution:**
1. Run `npm run build` locally
2. Commit and push changes
3. Redeploy on Vercel

### Issue: Database Connection Failed
**Solution:**
1. Verify MongoDB Atlas IP whitelist includes `0.0.0.0/0`
2. Check username and password in connection string
3. Ensure database name is correct

### Issue: Session/Auth Not Working
**Solution:**
1. Set `SESSION_DRIVER=cookie` in environment variables
2. Ensure `SESSION_DOMAIN` is set to your domain or null
3. Redeploy

---

## 📊 Monitoring & Logs

### View Logs
1. Go to Vercel Dashboard → Your Project
2. Click **Deployments**
3. Click on a deployment
4. View **Function Logs** and **Build Logs**

### Performance Monitoring
Vercel provides built-in analytics:
- Go to **Analytics** tab
- View page load times, visitor stats, etc.

---

## 🔄 Continuous Deployment

Vercel automatically deploys when you push to GitHub:
1. Make changes locally
2. Commit and push to GitHub:
   ```bash
   git add .
   git commit -m "Your changes"
   git push origin main
   ```
3. Vercel automatically builds and deploys

---

## 📝 Important Notes

### ⚠️ Limitations on Vercel Free Tier:
- **Serverless Function Timeout**: 10 seconds (Hobby), 60 seconds (Pro)
- **Bandwidth**: 100GB/month (Hobby)
- **Build Time**: 45 minutes/month (Hobby)

### 🎯 Best Practices:
1. **Use MongoDB Atlas** for production database (not local MongoDB)
2. **Set APP_DEBUG=false** in production
3. **Use strong APP_KEY** (never share it)
4. **Enable HTTPS** (Vercel does this automatically)
5. **Monitor logs** regularly for errors
6. **Backup database** regularly in MongoDB Atlas

### 🔐 Security:
- Never commit `.env` file
- Use strong passwords for MongoDB
- Keep `APP_KEY` secret
- Set `APP_DEBUG=false` in production
- Regularly update dependencies

---

## 🎉 Success Checklist

After deployment, verify:
- ✅ Application loads without errors
- ✅ Registration and login work
- ✅ Database operations work (create, read, update, delete notes)
- ✅ All pages render correctly
- ✅ Assets (CSS, JS, images) load properly
- ✅ No console errors in browser
- ✅ Mobile responsive design works
- ✅ All animations and interactions work

---

## 🆘 Need Help?

If you encounter issues:
1. Check Vercel Function Logs
2. Verify all environment variables are set correctly
3. Test MongoDB connection using MongoDB Compass
4. Check GitHub repository has all latest changes
5. Review Vercel documentation: https://vercel.com/docs

---

## 🚀 Your Deployment URLs

After deployment, you'll have:
- **Production URL**: `https://your-project.vercel.app`
- **Preview URLs**: Automatic for each branch/PR
- **Custom Domain**: (if configured)

---

**Congratulations! Your Notoliyo app is now live on Vercel! 🎉**

For any issues or questions, check the Vercel documentation or MongoDB Atlas support.
