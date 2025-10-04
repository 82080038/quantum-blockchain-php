# 📋 Installation Guide

## Prerequisites
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Web Server (Apache/Nginx)
- Composer

## Quick Installation

### Step 1: Download and Generate
```bash
php generate-project-simple.php
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Database Setup
```bash
mysql -u root -p < database/schema.sql
```

### Step 4: Configuration
```bash
cp .env.example .env
# Edit .env with your database settings
```

### Step 5: Access Application
```
http://localhost/quantum-blockchain-php/public/
```

## API Usage
- Default API Key: admin_key_12345
- All endpoints require API-Key header
- Check docs/api-reference.md for details

## Documentation
- Installation: docs/installation-guide.md
- API Reference: docs/api-reference.md
- Architecture: docs/architecture.md
- Deployment: deployment-guide.md

## Troubleshooting

### Common Issues
1. **Database Connection Error**
   - Verify credentials in .env
   - Check if MySQL is running
   - Ensure database exists

2. **API Key Authentication Failed**
   - Verify API key exists in database
   - Check if API key is active
   - Verify rate limits

3. **Permission Denied Errors**
   - Check file permissions
   - Verify web server user has access
   - Check SELinux/AppArmor settings

### Debug Mode
For troubleshooting, enable debug mode in .env:
```env
APP_DEBUG=true
APP_ENV=local
```
