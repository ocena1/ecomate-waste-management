# EcoMate - Traditional Web Hosting Setup

## 📁 Files to Upload

Upload these files from the `/app` folder to your web hosting:

```
📁 public_html/ (or www/ or htdocs/)
├── index.html
├── login.html
├── admin.php
├── auth.php
├── config.php
├── db_connect.php
├── get_bins.php
├── get_config.php
├── login.php
├── logout.php
├── manage_bins.php
├── whoami.php
└── (all other files from /app folder)
```

## 🗄️ Database Setup

1. **Create MySQL Database** in your hosting control panel
2. **Import Database**: Upload and import `db/init.sql`
3. **Note Database Details**:
   - Database Name: `your_db_name`
   - Username: `your_db_user`
   - Password: `your_db_password`
   - Host: `localhost` (usually)

## ⚙️ Configuration Steps

### Step 1: Update Database Connection

Edit `db_connect.php` with your hosting database details:

```php
<?php
$host = 'localhost'; // Your hosting database host
$db   = 'your_database_name'; // Your database name
$user = 'your_database_user'; // Your database username
$pass = 'your_database_password'; // Your database password
$charset = 'utf8mb4';
// ... rest of the file stays the same
```

### Step 2: Update Google Maps API Key

Edit `config.php` with your Google Maps API key:

```php
<?php
return [
    'google_maps_api_key' => 'YOUR_ACTUAL_API_KEY_HERE'
];
```

## 🌐 Free Hosting Options

### Option A: InfinityFree
- Website: [infinityfree.net](https://infinityfree.net)
- ✅ Free PHP hosting
- ✅ MySQL database included
- ✅ No ads on free plan

### Option B: 000webhost
- Website: [000webhost.com](https://000webhost.com)
- ✅ Free PHP hosting
- ✅ MySQL database
- ✅ Easy file manager

### Option C: AwardSpace
- Website: [awardspace.com](https://awardspace.com)
- ✅ Free hosting
- ✅ PHP & MySQL support

## 📋 Deployment Checklist

- [ ] Choose hosting provider
- [ ] Create hosting account
- [ ] Upload all files from `/app` folder
- [ ] Create MySQL database
- [ ] Import `init.sql` file
- [ ] Update `db_connect.php` with database details
- [ ] Update `config.php` with Google Maps API key
- [ ] Test the website

## 🔧 Testing Your Deployed Site

1. **Visit your website URL**
2. **Test login**: admin/admin123 and user/user123
3. **Check map loading**: Ensure Google Maps appears
4. **Test admin features**: Add/edit/delete bins (admin account)
5. **Test responsiveness**: Check on mobile

## 🚨 Common Issues & Solutions

**Map not loading:**
- Check Google Maps API key in `config.php`
- Ensure API key has "Maps JavaScript API" enabled

**Database connection error:**
- Verify database credentials in `db_connect.php`
- Check if database was imported correctly

**Login not working:**
- Ensure `users` table exists with sample data
- Check database connection

## 📞 Support

If you encounter issues:
1. Check hosting provider's error logs
2. Use browser developer tools (F12) to check for errors
3. Verify all files were uploaded correctly

---

**Your EcoMate system will be live and accessible worldwide! 🌍**