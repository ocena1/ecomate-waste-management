# 🚀 EcoMate Railway Deployment Guide

## 📋 Prerequisites
- GitHub Desktop installed
- GitHub account created
- Google Maps API key ready

## 🎯 Step-by-Step Deployment

### Step 1: Setup GitHub Repository

1. **Open GitHub Desktop**
2. **Create New Repository**:
   - Name: `ecomate-waste-management`
   - Description: `Smart waste management system with route optimization`
   - Local Path: Choose a location (e.g., Documents/GitHub/)
   - ✅ Initialize with README

3. **Copy Project Files**:
   - Copy ALL files from your eco-waste-bridge folder
   - Paste into the new repository folder
   - Replace the README.md with the new one

4. **Commit and Push**:
   - In GitHub Desktop, you'll see all files listed
   - Add commit message: "Initial commit - EcoMate System"
   - Click "Commit to main"
   - Click "Publish repository" (make it public)

### Step 2: Deploy to Railway

1. **Go to Railway**: [railway.app](https://railway.app)
2. **Sign up with GitHub** (use same GitHub account)
3. **Create New Project**:
   - Click "New Project"
   - Select "Deploy from GitHub repo"
   - Choose your `ecomate-waste-management` repository
   - Click "Deploy Now"

### Step 3: Add MySQL Database

1. **In Railway Dashboard**:
   - Click "New" → "Database" → "Add MySQL"
   - Wait for database to be created
   - Note the database connection details

2. **Import Database**:
   - Click on MySQL service
   - Go to "Data" tab
   - Click "Query" and paste contents of your `init.sql` file
   - Execute the query

### Step 4: Configure Environment Variables

In your Railway project, go to your web service and add these variables:

```
GOOGLE_MAPS_API_KEY=your_actual_api_key_here
RAILWAY_ENVIRONMENT=production
```

**Note**: Railway automatically provides MySQL connection variables:
- `MYSQLHOST`
- `MYSQLPORT` 
- `MYSQLDATABASE`
- `MYSQLUSER`
- `MYSQLPASSWORD`

### Step 5: Test Your Deployment

1. **Get your Railway URL** (shown in dashboard)
2. **Test the website**:
   - Visit your Railway URL
   - Login with: admin/admin123 or user/user123
   - Check if map loads
   - Test admin features

## 🎉 You're Live!

Your EcoMate system is now deployed at: `https://your-project-name.up.railway.app`

## 🔧 Troubleshooting

### Map not loading:
- Check Google Maps API key in environment variables
- Ensure API has "Maps JavaScript API" enabled

### Database connection error:
- Check if MySQL service is running in Railway
- Verify database was imported correctly
- Check environment variables

### General errors:
- Check Railway logs in dashboard
- Use browser developer tools (F12)

## 📱 Demo Credentials

**Admin Account:**
- Username: `admin`
- Password: `admin123`

**User Account:**
- Username: `user`  
- Password: `user123`

## 🎯 Final Checklist

- [ ] Repository created and pushed to GitHub
- [ ] Railway project deployed
- [ ] MySQL database added and imported
- [ ] Environment variables configured
- [ ] Website accessible and functional
- [ ] Login system working
- [ ] Map loading correctly
- [ ] Admin features working

## 🌟 Professional Features

Your deployed system includes:
- ✅ Real-time waste bin monitoring
- ✅ Route optimization with Google Maps
- ✅ Professional dashboard with analytics
- ✅ Dark/light theme toggle
- ✅ Mobile-responsive design
- ✅ Data export functionality
- ✅ User authentication system

**Perfect for your IT 111 presentation! 🎓**