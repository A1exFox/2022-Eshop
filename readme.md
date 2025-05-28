# Project Stack Updates and Setup  

## Stack Changes  

### PHP Version  
- Downgraded from PHP **8.4.5 → 8.3.21**  
- Required for stable CKFinder 3.7.0 compatibility  

### Docker & PHP Updates  
- `docker/php/Dockerfile` now includes GD extension dependencies  
- Modified `docker/php/config/php.ini` for better file handling  

### Action Required  
Rebuild the PHP image using:  
`make build`  is equivalent to `docker compose build`  
 

---

## CKFinder Setup  

1. **Download** CKFinder 3.7.0 (PHP) from:  
   → https://ckeditor.com/ckfinder/download/  
2. **Extract** the ZIP and place contents (except `config.php`) into:  
   → `www/public/adminlte/ckfinder/`  
   *(Project already has a pre-configured `config.php`)*  

3. Restart services:  
```sh  
make up  
```  
