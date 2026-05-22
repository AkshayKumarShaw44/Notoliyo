# 📋 Vercel Environment Variables - Easy Copy Table

## Copy each row and paste in Vercel Dashboard

| Variable Name | Value |
|---------------|-------|
| `APP_NAME` | `Notoliyo` |
| `APP_ENV` | `production` |
| `APP_KEY` | `base64:+N+Q9xpSn8OVT4nWYw2OuRa9Ug1iER+76Y/uGaVLIK0=` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://your-app.vercel.app` |
| `DB_CONNECTION` | `mongodb` |
| `MONGODB_DSN` | `mongodb+srv://akshaykumarshaw44_db_user:Pushpagupta123@cluster0.vab7cqk.mongodb.net/notoliyo?retryWrites=true&w=majority` |
| `SESSION_DRIVER` | `cookie` |
| `SESSION_LIFETIME` | `120` |
| `SESSION_ENCRYPT` | `false` |
| `SESSION_PATH` | `/` |
| `SESSION_DOMAIN` | `null` |
| `CACHE_STORE` | `file` |
| `CACHE_PREFIX` | `` |
| `QUEUE_CONNECTION` | `sync` |
| `LOG_CHANNEL` | `stack` |
| `LOG_LEVEL` | `error` |
| `MAIL_MAILER` | `log` |
| `MAIL_FROM_ADDRESS` | `hello@notoliyo.com` |
| `MAIL_FROM_NAME` | `Notoliyo` |
| `BROADCAST_CONNECTION` | `log` |
| `FILESYSTEM_DISK` | `local` |

---

## 🎯 How to Add in Vercel:

### Step 1: Go to Vercel Dashboard
1. Visit https://vercel.com/dashboard
2. Select your Notoliyo project
3. Click **Settings** tab
4. Click **Environment Variables** in sidebar

### Step 2: Add Each Variable
For each row in the table above:
1. Click **Add New** button
2. **Key**: Copy from "Variable Name" column (without backticks)
3. **Value**: Copy from "Value" column (without backticks)
4. **Environment**: Select **Production**, **Preview**, and **Development** (all three)
5. Click **Save**

### Step 3: Important Variables to Double-Check

#### ✅ APP_KEY (Critical!)
```
base64:+N+Q9xpSn8OVT4nWYw2OuRa9Ug1iER+76Y/uGaVLIK0=
```
⚠️ Copy exactly as shown, including `base64:` prefix

#### ✅ MONGODB_DSN (Critical!)
```
mongodb+srv://akshaykumarshaw44_db_user:Pushpagupta123@cluster0.vab7cqk.mongodb.net/notoliyo?retryWrites=true&w=majority
```
⚠️ Includes your database name `notoliyo` and connection parameters

#### ✅ APP_URL (Update After Deployment!)
```
https://your-app.vercel.app
```
⚠️ After first deployment, update this with your actual Vercel URL

---

## 🔄 After First Deployment:

1. **Get Your Vercel URL**
   - After deployment completes, Vercel will show your URL
   - Example: `https://notoliyo-abc123.vercel.app`

2. **Update APP_URL**
   - Go back to Environment Variables
   - Find `APP_URL`
   - Click **Edit**
   - Replace with your actual URL
   - Click **Save**

3. **Redeploy**
   - Go to **Deployments** tab
   - Click **Redeploy** on the latest deployment
   - Or push a new commit to GitHub

---

## ✅ Verification Checklist

After adding all variables:

- [ ] Total of 21 environment variables added
- [ ] APP_KEY includes `base64:` prefix
- [ ] MONGODB_DSN is complete with database name
- [ ] All variables saved for Production environment
- [ ] Ready to deploy!

---

## 🚀 Next Steps:

1. ✅ Add all environment variables in Vercel (done above)
2. ✅ Deploy your project
3. ✅ Get your Vercel URL
4. ✅ Update APP_URL with actual URL
5. ✅ Redeploy
6. ✅ Test your application!

---

## 🐛 Troubleshooting:

### If you get "Invalid APP_KEY":
- Make sure you copied the entire key including `base64:` prefix
- No extra spaces before or after

### If database connection fails:
- Verify MongoDB Atlas allows connections from anywhere (0.0.0.0/0)
- Check username and password are correct
- Ensure database name `notoliyo` exists or will be created

### If sessions don't work:
- Verify `SESSION_DRIVER=cookie` is set
- Clear browser cookies
- Try in incognito mode

---

## 📞 Need Help?

Check these files:
- **QUICK_DEPLOY.md** - Quick deployment guide
- **VERCEL_DEPLOYMENT_GUIDE.md** - Detailed guide
- **DEPLOYMENT_CHECKLIST.md** - Step-by-step checklist

---

**Your environment variables are ready! 🎉**

Copy them to Vercel and deploy!
