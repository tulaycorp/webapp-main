const fs = require('fs');
const path = require('path');

// Ensure dist directory exists
const distDir = path.join(__dirname, '..', 'dist');
if (!fs.existsSync(distDir)) {
  fs.mkdirSync(distDir, { recursive: true });
}

// Copy vendor JS files to dist
const vendorFiles = [
  {
    src: 'node_modules/jquery-validation/dist/jquery.validate.min.js',
    dest: 'dist/jquery.validate.min.js'
  },
  {
    src: 'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    dest: 'dist/bootstrap.bundle.min.js'
  }
];

vendorFiles.forEach(file => {
  const srcPath = path.join(__dirname, '..', file.src);
  const destPath = path.join(__dirname, '..', file.dest);
  
  try {
    fs.copyFileSync(srcPath, destPath);
    console.log(`✓ Copied ${file.src} to ${file.dest}`);
  } catch (error) {
    console.error(`✗ Failed to copy ${file.src}:`, error.message);
  }
});

console.log('JavaScript build complete!');