#!/bin/bash

echo "🚀 Starting Vercel build process..."

# Install PHP dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies
echo "📦 Installing NPM dependencies..."
npm install

# Build assets
echo "🎨 Building frontend assets..."
npm run build

# Create necessary directories
echo "📁 Creating storage directories..."
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo "✅ Build completed successfully!"
