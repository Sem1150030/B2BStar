clear-images: ## Delete all files in the public/images directory
	@echo "🧹 Clearing images..."
	rm -rf storage/app/public/images/* || true
	@echo "✅ Image folder cleared."

reset: ## Delete the database and all images in image folder and Remake the database + seed
	php artisan migrate:fresh --seed
	make clear-images
