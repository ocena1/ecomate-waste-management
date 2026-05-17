# EcoMate Setup Guide

## Quick Start

1. **Install Docker and Docker Compose**
   - Download from: https://www.docker.com/products/docker-desktop

2. **Get Google Maps API Key**
   - Go to: https://developers.google.com/maps/documentation/javascript/get-api-key
   - Enable "Maps JavaScript API" and "Directions API"
   - Copy your API key

3. **Configure API Key**
   - Edit `app/config.php`
   - Replace the placeholder API key with your actual key:
     ```php
     define('GOOGLE_MAPS_API_KEY', 'YOUR_ACTUAL_API_KEY_HERE');
     ```

4. **Start the Application**
   ```bash
   docker-compose up --build
   ```

5. **Access the Application**
   - Open: http://localhost:8080 (shows login page)
   - Login with credentials:
     - Admin: `admin` / `admin123` (full access to CRUD operations)
     - User: `user` / `user123` (read-only access)
   - After successful login, you'll be redirected to the main command center
   - Direct access to http://localhost:8080/index.html will redirect to login if not authenticated
   - Test page: http://localhost:8080/test.html (for debugging)

## Troubleshooting

### Application Not Loading
1. **Check if containers are running:**
   ```bash
   docker-compose ps
   ```

2. **Check container logs:**
   ```bash
   docker-compose logs web
   docker-compose logs db
   ```

3. **Test basic connectivity:**
   - Visit: http://localhost:8080/test.html
   - Should show a test page with working links

4. **Test API endpoints:**
   - http://localhost:8080/whoami.php (should return JSON)
   - http://localhost:8080/get_bins.php (should return bins data)
   - http://localhost:8080/get_config.php (should return config)

### Maps Not Loading
- Check your Google Maps API key in `app/config.php`
- Ensure "Maps JavaScript API" and "Directions API" are enabled
- Check browser console for API errors

### Database Connection Issues
- Ensure Docker containers are running: `docker-compose ps`
- Check logs: `docker-compose logs db`
- Wait a few seconds for MySQL to fully initialize

### Permission Issues
- Make sure Docker has permission to bind to port 8080
- Try a different port by changing `8080:80` to `8081:80` in docker-compose.yml

### Login Issues
- Try the test login form at http://localhost:8080/test.html
- Check browser console for JavaScript errors
- Verify database is initialized with user accounts

## Development

### File Structure
- `app/` - PHP application files
- `db/` - Database initialization scripts  
- `docs/` - Documentation
- `presentation/` - Presentation materials

### Key Files
- `app/index.html` - Main frontend application
- `app/config.php` - Configuration settings
- `app/manage_bins.php` - CRUD API for bins
- `app/get_bins.php` - Read API for bins
- `db/init.sql` - Database schema and sample data