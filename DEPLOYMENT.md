# EcoMate Deployment Guide

## Quick Deployment Options

### Option 1: Railway.app (Recommended)

1. **Create Railway Account**: Go to [railway.app](https://railway.app) and sign up
2. **Connect GitHub**: Link your GitHub account
3. **Upload Project**: Push your code to GitHub repository
4. **Deploy**: 
   - Click "New Project" → "Deploy from GitHub repo"
   - Select your repository
   - Railway will auto-detect Docker and deploy

**Environment Variables to Set in Railway:**
```
DB_HOST=mysql-service-url (Railway will provide this)
DB_NAME=eco_waste
DB_USER=root
DB_PASS=your_secure_password
GOOGLE_MAPS_API_KEY=your_api_key
APP_ENV=production
```

### Option 2: Render.com

1. **Create Render Account**: Go to [render.com](https://render.com)
2. **Create Web Service**: 
   - Connect GitHub repository
   - Choose "Docker" as environment
   - Set build command: `docker build -t ecomate .`
   - Set start command: `docker run -p 10000:80 ecomate`

### Option 3: Traditional Web Hosting

For shared hosting (like InfinityFree, 000webhost):

1. **Upload Files**: Upload contents of `/app` folder to public_html
2. **Create Database**: Create MySQL database in hosting control panel
3. **Import Database**: Import `/db/init.sql` file
4. **Update Config**: Edit `db_connect.php` with hosting database credentials

## Pre-Deployment Checklist

- [ ] Google Maps API key is configured
- [ ] Database credentials are secure
- [ ] All environment variables are set
- [ ] Test the application locally
- [ ] Backup current database

## Post-Deployment Steps

1. **Test Login**: Try both admin and user accounts
2. **Test Map**: Ensure Google Maps loads correctly
3. **Test CRUD**: Add/edit/delete bins (admin account)
4. **Test Responsiveness**: Check on mobile devices
5. **Performance Check**: Monitor loading times

## Troubleshooting

### Common Issues:

**Map not loading:**
- Check Google Maps API key
- Verify API key has Maps JavaScript API enabled
- Check browser console for errors

**Database connection failed:**
- Verify database credentials
- Check if database service is running
- Ensure database name matches configuration

**Login not working:**
- Check if users table exists
- Verify password hashing is working
- Check session configuration

## Live Demo Credentials

**Admin Account:**
- Username: `admin`
- Password: `admin123`

**User Account:**
- Username: `user`
- Password: `user123`

## Support

For deployment issues, check:
1. Browser console for JavaScript errors
2. Server logs for PHP errors
3. Database connection status
4. API key configuration

---

**Your EcoMate system is now ready for deployment!**