#!/bin/bash

# Laravel Deployment Script for Production
# Usage: ./deploy.sh

echo "🚀 Starting Laravel Deployment Process..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if .env file exists
if [ ! -f ".env" ]; then
    print_error ".env file not found!"
    if [ -f ".env.example" ]; then
        print_status "Copying .env.example to .env"
        cp .env.example .env
        print_warning "Please edit .env file with your production settings"
    else
        print_error ".env.example not found! Please create .env file manually"
        exit 1
    fi
fi

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    print_error "Composer is not installed!"
    exit 1
fi

# Install/Update Composer dependencies
print_status "Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

if [ $? -ne 0 ]; then
    print_error "Composer install failed!"
    exit 1
fi

# Generate application key if not set
if grep -q "APP_KEY=$" .env; then
    print_status "Generating application key..."
    php artisan key:generate --force
fi

# Run database migrations
print_status "Running database migrations..."
php artisan migrate --force

if [ $? -ne 0 ]; then
    print_warning "Database migration failed! Please check your database configuration"
fi

# Seed database (optional)
read -p "Do you want to seed the database? (y/N): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    print_status "Seeding database..."
    php artisan db:seed --force
fi

# Set proper permissions
print_status "Setting proper permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env

# Clear and cache configurations
print_status "Clearing application cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

print_status "Caching configurations for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create symbolic link for storage (if needed)
if [ ! -L "public/storage" ]; then
    print_status "Creating storage symbolic link..."
    php artisan storage:link
fi

# Final checks
print_status "Running final checks..."

# Check if APP_ENV is set to production
if ! grep -q "APP_ENV=production" .env; then
    print_warning "APP_ENV is not set to 'production' in .env file"
fi

# Check if APP_DEBUG is set to false
if ! grep -q "APP_DEBUG=false" .env; then
    print_warning "APP_DEBUG is not set to 'false' in .env file"
fi

# Check if database connection works
print_status "Testing database connection..."
php artisan migrate:status > /dev/null 2>&1

if [ $? -eq 0 ]; then
    print_status "Database connection successful!"
else
    print_warning "Database connection failed! Please check your database configuration"
fi

print_status "🎉 Deployment completed!"
print_status "Your application should now be ready at: $(grep APP_URL .env | cut -d '=' -f2)"

echo ""
print_status "📋 Post-deployment checklist:"
echo "   ✓ Verify .env configuration"
echo "   ✓ Test database connection"
echo "   ✓ Check file permissions"
echo "   ✓ Test application functionality"
echo "   ✓ Monitor error logs"

print_status "📁 Important files and folders:"
echo "   • Configuration: .env"
echo "   • Logs: storage/logs/"
echo "   • Cache: bootstrap/cache/"
echo "   • Public files: public/"

echo ""
print_status "Deployment script completed successfully! 🚀"