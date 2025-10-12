clear-images: ## Delete all product files in the public/images directory
	@echo "🧹 Clearing images..."
	rm -rf storage/app/public/images/ProductImages/* || true
	@echo "✅ Image folder cleared."

reset: ## Delete the database and all images in image folder and Remake the database + seed
	php artisan migrate:fresh --seed
	make clear-images

migrate: ## Run the database migrations
	php artisan migrate

clear: ## Clear all caches / views/routes/config
	php artisan optimize:clear
	php artisan cache:clear
	@echo "✅ Caches cleared."
